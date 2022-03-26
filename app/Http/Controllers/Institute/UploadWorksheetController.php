<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\UploadWorksheet;
use Illuminate\Support\Facades\Storage;

class UploadWorksheetController extends Controller
{
    public function index(){
        $institute = Auth::guard('institute')->user();

        $worksheets = UploadWorksheet::where('created_by', 'institute')->where('created_by_id', $institute->id)->latest()->paginate(10);

        return view('institute.upload_worksheet.index', compact('worksheets'));
    }

    public function worksheetUpload(Request $request){
        $post = $request->all();

        if($request->worksheets != null){
            $path = 'worksheets';
            $institute = Auth::guard('institute')->user();

            foreach ($request->worksheets as $file) {                            
                $filename = file_upload($file, $path); //call helper function

                UploadWorksheet::create([
                    'worksheet_name' => $filename,
                    'created_by' => 'institute',
                    'created_by_id' => $institute->id
                ]);
            }

            return redirect()->back()->with('success', 'Worksheet uploaded');
        }
    }

    public function destroy($id){
        $worksheet = UploadWorksheet::findOrFail($id);

        Storage::disk('public')->delete('worksheets/'.$worksheet->worksheet_name);

        $worksheet->delete();

        return redirect()->back()->with('success', 'Worksheet deleted');
    }

    public function worksheetDownload($id){
        $worksheet = UploadWorksheet::findOrFail($id);        

        return Storage::disk('public')->download('worksheets/'.$worksheet->worksheet_name);
    }
}
