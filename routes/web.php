<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('home.index');
    });

    Route::resource('home', 'HomeController');

    Route::resource('pages', 'PagesController');
    Route::post('pages/move', ['as' => 'pages.move', 'uses' => 'PagesController@move']);

    Route::resource('menus', 'MenusController');
    Route::resource('menus.items', 'MenusItemsController');
    Route::post('menus/positions', ['as' => 'menus.positions', 'uses' => 'MenusController@positions']);
    Route::post('menus/items/move', ['as' => 'menus.items.move', 'uses' => 'MenusItemsController@move']);

    Route::resource('forms', 'FormsController');
    Route::resource('forms.fields', 'FormsFieldsController');
    Route::post('forms/fields/move', ['as' => 'forms.fields.move', 'uses' => 'FormsFieldsController@move']);

    Route::resource('labels', 'LabelsController');
    Route::resource('themes', 'ThemesController');

    Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], function () {
        Route::get('/', ['as' => 'index', function () {
            return redirect()->route('settings.general.index');
        }]);

        Route::resource('users', 'UsersController');
        Route::resource('general', 'GeneralController');
        Route::resource('notfound', 'NotfoundController');
        Route::resource('maintenance', 'MaintenanceController');
    });
});

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::group([], function () {
    Route::get('image/{path}', ['as' => 'image', 'uses' => 'PagesController@image'])->where('path', '.+');
    Route::post('contact/{form}', ['as' => 'contact.register', 'uses' => 'ContactController@register'])->where('form', '[0-9]+');

    Route::any('/', ['as' => 'website.home', 'uses' => 'PagesController@index']);
    Route::any('{path?}', ['as' => 'website.page', 'uses' => 'PagesController@page'])->where('path', '.*');
});
