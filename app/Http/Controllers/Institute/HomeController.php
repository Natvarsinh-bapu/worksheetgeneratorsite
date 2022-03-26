<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use App\Category;
use App\Concept;
use App\Type;
use App\SubConcept;
use Auth;

class HomeController extends Controller
{

    protected $redirectTo = '/institute/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('institute.auth:institute');
    }

    /**
     * Show the Institute dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $institute = Auth::guard('institute')->user();

        $total_categories = Category::where('created_by', 'institute')->where('created_by_id', $institute->id)->count();
        $total_concepts = Concept::where('created_by', 'institute')->where('created_by_id', $institute->id)->count();
        $total_types = Type::where('created_by', 'institute')->where('created_by_id', $institute->id)->count();
        $total_sub_concepts = SubConcept::where('created_by', 'institute')->where('created_by_id', $institute->id)->count();

        return view('institute.home', compact('total_categories', 'total_concepts', 'total_types', 'total_sub_concepts'));
    }

}
