<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Profiles
    Route::delete('profiles/destroy', 'ProfileController@massDestroy')->name('profiles.massDestroy');
    Route::post('profiles/media', 'ProfileController@storeMedia')->name('profiles.storeMedia');
    Route::post('profiles/ckmedia', 'ProfileController@storeCKEditorImages')->name('profiles.storeCKEditorImages');
    Route::resource('profiles', 'ProfileController');

    // Certificates
    Route::delete('certificates/destroy', 'CertificateController@massDestroy')->name('certificates.massDestroy');
    Route::post('certificates/media', 'CertificateController@storeMedia')->name('certificates.storeMedia');
    Route::post('certificates/ckmedia', 'CertificateController@storeCKEditorImages')->name('certificates.storeCKEditorImages');
    Route::resource('certificates', 'CertificateController');

    // Regions
    Route::delete('regions/destroy', 'RegionController@massDestroy')->name('regions.massDestroy');
    Route::resource('regions', 'RegionController', ['except' => ['create', 'store']]);

    // Places
    Route::delete('places/destroy', 'PlaceController@massDestroy')->name('places.massDestroy');
    Route::resource('places', 'PlaceController', ['except' => ['create', 'store']]);

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    Route::resource('categories', 'CategoryController');

    // Subcategories
    Route::delete('subcategories/destroy', 'SubcategoryController@massDestroy')->name('subcategories.massDestroy');
    Route::post('subcategories/media', 'SubcategoryController@storeMedia')->name('subcategories.storeMedia');
    Route::post('subcategories/ckmedia', 'SubcategoryController@storeCKEditorImages')->name('subcategories.storeCKEditorImages');
    Route::resource('subcategories', 'SubcategoryController');

    // Products
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Settings
    Route::resource('settings', 'SettingsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});