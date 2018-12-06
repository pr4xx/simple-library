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
    if(auth()->check()) {
        return redirect('home');
    }

    return view('welcome');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::middleware('auth', 'menu')->group(function() {
    Route::get('home', 'HomeController@index');

    Route::any('books/data', 'BookController@data');
    Route::resource('books', 'BookController');

    Route::any('readers/data', 'ReaderController@data');
    Route::resource('readers', 'ReaderController');

    Route::any('lendings/data', 'LendingController@data');
    Route::resource('lendings', 'LendingController')->except('destroy');

    Route::any('tables/authors/data', 'AuthorController@data');
    Route::resource('tables/authors', 'AuthorController');

    Route::any('tables/origins/data', 'OriginController@data');
    Route::resource('tables/origins', 'OriginController');

    Route::any('tables/categories/data', 'CategoryController@data');
    Route::resource('tables/categories', 'CategoryController');

    Route::any('tables/tags/data', 'TagController@data');
    Route::resource('tables/tags', 'TagController');
});


