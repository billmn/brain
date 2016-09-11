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
    Route::post('menus/items/move', ['as' => 'menus.items.move', 'uses' => 'MenusItemsController@move']);

    Route::resource('forms', 'FormsController');
    Route::resource('forms.fields', 'FormsFieldsController');
    Route::post('forms/fields/move', ['as' => 'forms.fields.move', 'uses' => 'FormsFieldsController@move']);

    Route::resource('labels', 'LabelsController');
    Route::resource('themes', 'ThemesController');

    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
        Route::get('/', ['as' => 'settings.index', function () {
            return redirect()->route('settings.general.index');
        }]);

        Route::resource('general', 'GeneralController', ['names' => [
            'index'   => 'settings.general.index',
            'store'   => 'settings.general.store',
        ]]);

        Route::resource('notfound', 'NotfoundController', ['names' => [
            'index'   => 'settings.notfound.index',
            'store'   => 'settings.notfound.store',
        ]]);

        Route::resource('maintenance', 'MaintenanceController', ['names' => [
            'index'   => 'settings.maintenance.index',
            'store'   => 'settings.maintenance.store',
        ]]);

        Route::resource('users', 'UsersController', ['names' => [
            'index'   => 'settings.users.index',
            'create'  => 'settings.users.create',
            'store'   => 'settings.users.store',
            'show'    => 'settings.users.show',
            'edit'    => 'settings.users.edit',
            'update'  => 'settings.users.update',
            'destroy' => 'settings.users.destroy',
        ]]);
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
