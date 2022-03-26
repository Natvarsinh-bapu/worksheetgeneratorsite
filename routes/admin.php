<?php

Route::group(['namespace' => 'Admin'], function() {

    Route::redirect('/', '/admin/dashboard')->name('admin');
    Route::get('dashboard', 'HomeController@index')->name('admin.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Register
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    // Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    
    // Verify
    Route::get('verification/{token}', 'Auth\VerificationController@verifyAdmin');
    Route::post('request-categories', 'Auth\VerificationController@requestCategories');
    // Route::get('email/resend', 'Auth\VerificationController@resend')->name('admin.verification.resend');
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('admin.verification.notice');
    // Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('admin.verification.verify');

    Route::group(['middleware' => 'auth:admin'], function() {
        Route::get('change-password', 'Auth\ChangePasswordController@change_password_form');
        Route::post('change-password', 'Auth\ChangePasswordController@change_password')->name('admin.change-password');

        Route::resource('categories', 'CategoryController');
        Route::get('categories-datatable', 'CategoryController@datatable');
        Route::post('delete-category', 'CategoryController@destroy');

        Route::resource('concepts', 'ConceptController');
        Route::get('concepts-datatable', 'ConceptController@datatable');
        Route::post('delete-concept', 'ConceptController@destroy');

        Route::resource('sub-concepts', 'SubconceptController');
        Route::get('sub-concepts-datatable', 'SubconceptController@datatable');
        Route::post('delete-sub-concepts', 'SubconceptController@destroy');
        Route::post('get-concepts', 'SubconceptController@concepts');

        Route::resource('types', 'TypeController');
        Route::get('types-datatable', 'TypeController@datatable');
        Route::post('delete-type', 'TypeController@destroy');
        Route::post('get-concepts-for-types', 'TypeController@conceptsForType');
        Route::post('get-sub-concepts-for-types', 'TypeController@subConceptsForType');
        Route::post('delete-type-image', 'TypeController@deleteTypeImage');

        Route::get('profile', 'ProfileController@index');
        Route::post('change-profile-pic', 'ProfileController@changeProfilePic');
        Route::post('update-admin-details', 'ProfileController@updateAdminDetails');

        Route::resource('institutes', 'InstituteController');
        Route::get('institutes-datatable', 'InstituteController@datatable');
        Route::post('delete-institute', 'InstituteController@destroy');

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
    });
});