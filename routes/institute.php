<?php

Route::group(['namespace' => 'Institute'], function() {

    Route::redirect('/', '/institute/dashboard')->name('institute');
    Route::get('dashboard', 'HomeController@index')->name('institute.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('institute.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('institute.logout');

    // Register
    Route::get('register/{unique_token}', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('institute.register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('institute.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('institute.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('institute.password.reset');

    // Verify
    // Route::get('email/resend', 'Auth\VerificationController@resend')->name('institute.verification.resend');
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('institute.verification.notice');
    // Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('institute.verification.verify');

    Route::group(['middleware' => 'auth:institute'], function() {
        Route::get('change-password', 'Auth\ChangePasswordController@change_password_form');
        Route::post('change-password', 'Auth\ChangePasswordController@change_password')->name('institute.change-password');

        Route::resource('categories', 'CategoryController');
        Route::get('categories-datatable', 'CategoryController@datatable');
        Route::post('delete-category', 'CategoryController@destroy');

        Route::resource('concepts', 'ConceptController');
        Route::get('concepts-datatable', 'ConceptController@datatable');
        Route::post('delete-concept', 'ConceptController@destroy');

        Route::resource('sub-concepts', 'SubconceptController');
        Route::get('sub-concepts-datatable', 'SubconceptController@datatable');
        Route::post('delete-sub-concepts', 'SubconceptController@destroy');

        Route::resource('types', 'TypeController');
        Route::get('types-datatable', 'TypeController@datatable');
        Route::post('delete-type', 'TypeController@destroy');        

        Route::get('profile', 'ProfileController@index');
        Route::post('change-profile-pic', 'ProfileController@changeProfilePic');
        Route::post('update-institute-details', 'ProfileController@updateInstituteDetails');

        Route::get('worksheets', 'WorksheetController@selectLayout');
        Route::get('layouts/{id}', 'WorksheetController@generateWorksheet');
        Route::post('get-images-for-appeds', 'WorksheetController@getImagesForAppends');
        Route::post('save-html-worksheet', 'WorksheetController@saveHtmlWorksheet');
        Route::get('edit-worksheets', 'WorksheetController@editableWorksheets');
        Route::get('edit-worksheets/{id}', 'WorksheetController@editWorksheet');
        Route::post('remove-worksheet', 'WorksheetController@removeWorksheet');

        Route::resource('upload-worksheets', 'UploadWorksheetController');
        Route::post('worksheet-upload', 'UploadWorksheetController@worksheetUpload');
        Route::get('worksheet-download/{id}', 'UploadWorksheetController@worksheetDownload');

        Route::resource('class', 'ClassController');
        Route::get('class-datatable', 'ClassController@datatable');
        Route::post('delete-class', 'ClassController@destroy');

        Route::resource('teachers', 'TeacherController');
        Route::get('teachers-datatable', 'TeacherController@datatable');
        Route::post('delete-teacher', 'TeacherController@destroy');

        Route::resource('students', 'StudentController');
        Route::get('students-datatable', 'StudentController@datatable');
        Route::post('delete-student', 'StudentController@destroy');
    });

});