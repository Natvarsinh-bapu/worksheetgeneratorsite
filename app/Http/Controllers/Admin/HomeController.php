<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Concept;
use App\Type;
use App\SubConcept;
use Auth;
use App\Question;
use App\Institute;
use App\AdminCategoriesAccess;

class HomeController extends Controller
{

    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $admin = Auth::guard('admin')->user();

        $accessable_categories_ids = AdminCategoriesAccess::where('admin_id', $admin->id)->where('status', 1)->pluck('category_id')->toArray();

        $total_categories = Category::where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id)->count();
        $total_concepts = Concept::where('created_by', 'admin')->where('created_by_id', $admin->id)->count();
        $total_types = Type::where('created_by', 'admin')->where('created_by_id', $admin->id)->count();
        $total_sub_concepts = SubConcept::where('created_by', 'admin')->where('created_by_id', $admin->id)->count();
        $total_questions = Question::where('created_by', 'admin')->where('created_by_id', $admin->id)->count();
        $total_institutes = Institute::where('admin_id', $admin->id)->count();

        return view('admin.home', compact('admin', 'total_categories', 'total_concepts', 'total_types', 'total_sub_concepts', 'total_questions', 'total_institutes'));
    }

}
