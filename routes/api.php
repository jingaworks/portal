<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Profiles
    Route::post('profiles/media', 'ProfileApiController@storeMedia')->name('profiles.storeMedia');
    Route::apiResource('profiles', 'ProfileApiController');

    // Certificates
    Route::post('certificates/media', 'CertificateApiController@storeMedia')->name('certificates.storeMedia');
    Route::apiResource('certificates', 'CertificateApiController');

    // Regions
    Route::apiResource('regions', 'RegionApiController', ['except' => ['store']]);

    // Places
    Route::apiResource('places', 'PlaceApiController', ['except' => ['store']]);

    // Categories
    Route::post('categories/media', 'CategoryApiController@storeMedia')->name('categories.storeMedia');
    Route::apiResource('categories', 'CategoryApiController');

    // Subcategories
    Route::post('subcategories/media', 'SubcategoryApiController@storeMedia')->name('subcategories.storeMedia');
    Route::apiResource('subcategories', 'SubcategoryApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');
});