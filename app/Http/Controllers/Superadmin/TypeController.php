<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\TypeImage;
use App\Category;
use App\Concept;
use App\SubConcept;
use Validator;
use Auth;
use DataTables;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $superadmin = Auth::guard('superadmin')->user();

        $categories = Category::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->where('status', 1)->pluck('category', 'id');

        return view('superadmin.types.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();

        $messages = [
            'type.required' => 'Please enter type',
            'type.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'type' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('superadmin/types/create')
                ->withErrors($validator)
                ->withInput();
        }

        $superadmin = Auth::guard('superadmin')->user();

        $post['created_by_id'] = $superadmin->id;
        $post['created_by'] = 'superadmin';

        $type = Type::create($post)->id;

        if ($type && !empty($post['images'])) {
            $path = 'question_type_files';
            foreach ($post['images'] as $file) {
                $filename = file_upload($file, $path);
                TypeImage::create([
                    'question_type_id' => $type,
                    'image' => $filename
                ]);
            }
        }

        if ($type) {
            return redirect('superadmin/types')->with('success', 'Type created successfully.');
        } else {
            return redirect('superadmin/types')->with('error', 'Type not created, Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type::with('category', 'concept', 'sub_concept', 'images')->findOrFail($id);

        return view('superadmin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type::findOrFail($id);

        $superadmin = Auth::guard('superadmin')->user();

        $categories = Category::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->where('status', 1)->pluck('category', 'id');

        $type_images = TypeImage::where('question_type_id', $type->id)->get();

        return view('superadmin.types.edit', compact('type', 'categories', 'type_images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->all();

        $messages = [
            'type.required' => 'Please enter type',
            'type.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'type' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('superadmin/types/create')
                ->withErrors($validator)
                ->withInput();
        }

        $superadmin = Auth::guard('superadmin')->user();

        $type = Type::find($id);

        $type->update($post);

        if ($type && !empty($post['images'])) {
            $path = 'question_type_files';
            foreach ($post['images'] as $file) {
                $filename = file_upload($file, $path);
                TypeImage::create([
                    'question_type_id' => $type->id,
                    'image' => $filename
                ]);
            }
        }
        return redirect('superadmin/types')->with('success', 'Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = $request->all();

        $type = Type::findOrFail($post['id']);

        $type_images = TypeImage::where('question_type_id', $type->id)->get();

        if ($type_images->isNotEmpty()) {
            foreach ($type_images as $type_image) {
                $file = $path = public_path() . '/uploads/question_type_files/' . $type_image->image;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        $type->delete();

        return redirect('superadmin/types')->with('success', 'Type deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable()
    {
        $superadmin = Auth::guard('superadmin')->user();

        $type = Type::with('category', 'concept', 'sub_concept')->where('status', 1)->where('created_by', 'superadmin')->where('created_by_id', $superadmin->id);

        return Datatables::of($type)
            ->editColumn('category_id', function ($type) {
                return $type->category->category;
            })
            ->editColumn('concept_id', function ($type) {
                return $type->concept->concept;
            })
            ->editColumn('sub_concept_id', function ($type) {
                return $type->sub_concept->sub_concept;
            })
            ->addColumn('action', function ($type) {
                return '<a class="btn btn-default" href="/superadmin/types/' . $type->id . '" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
                    . '<a class="btn btn-primary" href="/superadmin/types/' . $type->id . '/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
                    . '<a data-id="' . $type->id . '" class="btn btn-danger _remove_type" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->make();
    }

    /**
     * function for get concepts of particular category
     */
    public function conceptsForType(Request $request)
    {
        $post = $request->all();

        $concepts = Concept::where('category_id', $post['category_id'])->where('status', 1)->get();

        if ($post['is_for'] == 'edit') {
            $type = Type::find($post['type_id']);

            if ($type) {
                $selected_concept = $type->concept_id;
            } else {
                $selected_concept = 0;
            }

            return response()->json(['success' => true, 'concepts' => $concepts, 'selected_concept' => $selected_concept]);
        } else {
            return response()->json(['success' => true, 'concepts' => $concepts]);
        }
    }

    /**
     * function for get sub concepts of particular concepts
     */
    public function subConceptsForType(Request $request)
    {
        $post = $request->all();

        $sub_concepts = SubConcept::where('concept_id', $post['concept_id'])->where('status', 1)->get();

        if ($post['is_for'] == 'edit') {
            $type = Type::find($post['type_id']);

            if ($type) {
                $selected_sub_concept = $type->sub_concept_id;
            } else {
                $selected_sub_concept = 0;
            }

            return response()->json(['success' => true, 'sub_concepts' => $sub_concepts, 'selected_sub_concept' => $selected_sub_concept]);
        } else {
            return response()->json(['success' => true, 'sub_concepts' => $sub_concepts]);
        }
    }

    /**
     * DELETE TYPE IMAGE
     */
    public function deleteTypeImage(Request $request)
    {
        $post = $request->all();

        $type_image = TypeImage::find($post['id']);

        if ($type_image) {
            if ($type_image->image != '' && $type_image->image != null) {
                $file = public_path() . '/uploads/question_type_files/' . $type_image->image;
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $type_image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No record found'
            ]);
        }
    }
}
