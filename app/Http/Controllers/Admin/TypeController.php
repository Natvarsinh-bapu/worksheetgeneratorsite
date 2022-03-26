<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\Category;
use App\Concept;
use App\SubConcept;
use App\AdminCategoriesAccess;
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
        return view('admin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();

        $accessable_categories_ids = AdminCategoriesAccess::where('admin_id', $admin->id)->where('status', 1)->pluck('category_id')->toArray();
        $categories = Category::where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id)->orWhereIn('id', $accessable_categories_ids)->pluck('category', 'id');

        return view('admin.types.add', compact('categories'));
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
            return redirect('admin/types/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $admin = Auth::guard('admin')->user();

        $post['created_by_id'] = $admin->id;
        $post['created_by'] = 'admin';

        $type = Type::create($post)->id;

        if($type){
            return redirect('admin/types')->with('success', 'Type created successfully.');
        } else {
            return redirect('admin/types')->with('error', 'Type not created, Something went wrong.');
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
        $type = Type::findOrFail($id);
        return view('admin.types.show', compact('type'));
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
        return view('admin.types.edit', compact('type'));
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
            return redirect('admin/types/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $type = Type::findOrFail($id);

        $type->update($post);

        return redirect('admin/types')->with('success', 'Type updated successfully.');
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

        $type->delete();

        return redirect('admin/types')->with('success', 'Type deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $admin = Auth::guard('admin')->user();

        $type = Type::with('category', 'concept', 'sub_concept')->where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id);

        return Datatables::of($type)
        ->editColumn('category_id', function($type){
            return $type->category->category;
        })
        ->editColumn('concept_id', function($type){
            return $type->concept->concept;
        })
        ->editColumn('sub_concept_id', function($type){
            return $type->sub_concept->sub_concept;
        })
        ->addColumn('action', function($type) {
            return '<a class="btn btn-default" href="/admin/types/'.$type->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/admin/types/'.$type->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $type->id .'" class="btn btn-danger _remove_type" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }

    /**
     * function for get concepts of particular category
     */
    public function conceptsForType (Request $request){
        $post = $request->all();

        $concepts = Concept::where('category_id', $post['category_id'])->where('status', 1)->get();

        if($post['is_for'] == 'edit'){
            $type = Type::find($post['type_id']);

            if($type){
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
    public function subConceptsForType(Request $request){
        $post = $request->all();

        $sub_concepts = SubConcept::where('concept_id', $post['concept_id'])->where('status', 1)->get();

        if($post['is_for'] == 'edit'){
            $type = Type::find($post['type_id']);

            if($type){
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
