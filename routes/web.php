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
});

Route::group(['prefix' => 'category'], function () {
    
    Route::post('create', 'CategoryController@createCategory');
    Route::get('edit/{id}', 'CategoryController@editCategory');
    Route::post('update', 'CategoryController@updateCategory');
    Route::post('delete', 'CategoryController@deleteCategory');
});

Route::group(['prefix' => 'subcategory'], function () {
    
    Route::post('create', 'CategoryController@createSubCategory');
    Route::get('edit/{id}', 'CategoryController@editSubCategory');
    Route::post('update', 'CategoryController@updateSubCategory');
    Route::post('delete', 'CategoryController@deleteSubCategory');
});