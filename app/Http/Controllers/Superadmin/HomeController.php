<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Concept;
use App\Type;
use App\SubConcept;
use App\Question;
use App\Template;
use App\Admin;
use App\UploadWorksheet;
use App\HtmlWorksheet;
use Auth;

class HomeController extends Controller
{

    protected $redirectTo = '/superadmin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('superadmin.auth:superadmin');
    }

    /**
     * Show the Superadmin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $superadmin = Auth::guard('superadmin')->user();

        $total_categories = Category::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->count();
        $total_concepts = Concept::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->count();
        $total_types = Type::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->count();
        $total_sub_concepts = SubConcept::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->count();
        $total_questions = Question::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->count();        
        $total_templates = Template::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->count();
        $total_uploaded = UploadWorksheet::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->count();
        $total_admins = Admin::count();
        $total_html_worksheet = HtmlWorksheet::count();

        return view('superadmin.home', compact(
            'total_categories', 
            'total_concepts', 
            'total_types', 
            'total_sub_concepts',
            'total_questions',
            'total_admins',
            'total_templates',
            'total_uploaded',
            'total_html_worksheet'
        ));
    }

}
