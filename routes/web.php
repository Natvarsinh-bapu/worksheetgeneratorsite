<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes();
Route::get('register', function(){
    abort(404);
});

Route::redirect('/home', 'dashboard')->name('home');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('profile', 'UserController@profile')->name('profile');    

    Route::group(['namespace' => 'Teacher', 'middleware' => 'teacher'], function(){
        Route::get('/students/{class_id}', 'StudentController@index')->name('students');
        Route::get('/worksheets', 'WorksheetController@index')->name('worksheets');
        Route::get('/get-students/{class_id}', 'WorksheetController@studentsByClass')->name('get-students');
        Route::post('/assign-to-students', 'WorksheetController@assignToStudents')->name('assign-to-students');
        Route::get('/assigned-worksheets/{class_id}', 'WorksheetController@assignedWorksheets')->name('assigned-worksheets');
        Route::get('/student-worksheets/{student_id}', 'WorksheetController@studentWorksheets')->name('student-worksheets');
    });

    Route::group(['namespace' => 'Student', 'middleware' => 'student'], function(){
        Route::get('/my-worksheets/{teacher_id}', 'WorksheetController@myWorksheets')->name('my-worksheets');
    });
});


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    dd('Done');
});

