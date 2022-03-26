<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Concept;
use App\SubConcept;
use App\Type;
use App\TypeImage;
use App\UploadWorksheet;
use App\HtmlWorksheet;
use Illuminate\Support\Facades\Storage;
use PDF;
use Carbon\Carbon;
use Auth;

class WorksheetController extends Controller
{
    public function selectLayout(){
        $categories = Category::pluck('category', 'id')->prepend('Select Category', '');
        $concepts = Concept::pluck('concept', 'id')->prepend('Select Concept', '');
        $sub_concepts = SubConcept::pluck('sub_concept', 'id')->prepend('Select Sub Concept', '');
        $types = Type::pluck('type', 'id')->prepend('Select Type', '');

        return view('admin.worksheet.layout_selection', compact('categories', 'concepts', 'sub_concepts', 'types'));
    }

    public function generateWorksheet($id){
        $categories = Category::pluck('category', 'id')->prepend('Select Category', '');
        $concepts = Concept::pluck('concept', 'id')->prepend('Select Concept', '');
        $sub_concepts = SubConcept::pluck('sub_concept', 'id')->prepend('Select Sub Concept', '');
        $types = Type::pluck('type', 'id')->prepend('Select Type', '');

        return view('admin.worksheet.layout_main', compact('id', 'categories', 'concepts', 'sub_concepts', 'types'));
    }

    public function getImagesForAppends(Request $request){
        $post = $request->all();
        $last_id = $post['last_id'];

        $images = TypeImage::where('id', '>', $last_id)->take(20)->get();

        
        if($images->isNotEmpty()){
            $last_id = $images->last()->id;
        }

        return response()->json([
            'success' => true,
            'images' => $images,
            'last_id' => $last_id
        ]);
    }

    public function saveHtmlWorksheet(Request $request){        
        $admin = Auth::guard('admin')->user();

        HtmlWorksheet::create([
            'html' => $request->html,
            'question' => $request->question,
            'created_by_id' => $admin->id,
            'created_by' => 'admin'
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function editableWorksheets(){
        $admin = Auth::guard('admin')->user();

        $worksheets = HtmlWorksheet::where('created_by', 'admin')->where('created_by_id', $admin->id)->latest()->paginate(10);

        return view('admin.worksheet.edit_index', compact('worksheets'));
    }

    public function editWorksheet($id){
        $worksheet = HtmlWorksheet::find($id);

        return view('admin.worksheet.edit', compact('worksheet'));
    }

    public function removeWorksheet(Request $request){
        HtmlWorksheet::destroy($request->id);

        return redirect('admin/edit-worksheets')->with('success', 'Worksheet deleted');
    }
}
