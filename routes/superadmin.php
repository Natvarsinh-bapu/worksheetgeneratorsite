<?php

Route::group(['namespace' => 'Superadmin'], function() {

    Route::redirect('/', '/superadmin/dashboard')->name('superadmin');
    Route::get('dashboard', 'HomeController@index')->name('superadmin.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('superadmin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('superadmin.logout');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('superadmin.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('superadmin.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('superadmin.password.reset');

    Route::group(['middleware' => 'auth:superadmin'], function() {
        Route::get('change-password', 'Auth\ChangePasswordController@change_password_form');
        Route::post('change-password', 'Auth\ChangePasswordController@change_password')->name('superadmin.change-password');

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
        
        Route::resource('worksheet', 'GenerateWorksheetController');
        Route::get('worksheets-datatable', 'GenerateWorksheetController@datatable');
        Route::post('delete-worksheet', 'GenerateWorksheetController@destroy');
        Route::get('download-worksheet-pdf/{id}', 'GenerateWorksheetController@downloadWorksheetPDF');
        Route::post('filter-questions', 'GenerateWorksheetController@filterQuestions');

        Route::resource('admins', 'AdminController');
        Route::get('admins-datatable', 'AdminController@datatable');
        Route::post('delete-admin', 'AdminController@destroy');
        Route::post('change-admin-status', 'AdminController@changeAdminStatus');
        Route::get('category-access/{id}', 'AdminController@categoryAccess');
        Route::post('access-category-status', 'AdminController@accessCategoryStatus');

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