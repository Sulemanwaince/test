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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('export_file_download');
});

//Route::get('/', function () {
//    return view('export_file_download');
//});

Route::get('/vuejs', function () {
    return view('new');
});
Route::group(['prefix'=>'tasks'],function(){
    Route::get('/view',function(){
        return view('task');
    });
    Route::get('/','TasksController@index');
    Route::delete('/{id}','TasksController@del');
    Route::post('/','TasksController@store');
  //  Route::('/{id}','TasksController@del');
});

/*
Route::get('/vuejs','newController@index');
Route::post('/vuejs/import','newController@import');
*/

Route::get('/export_excel/download','ExportExcelController@download');
Route::get('/import_excel','ImportExcelController@index');
Route::post('/import_excel/import','ImportExcelController@import');


Route::get('/export_excel', 'ExportExcelController@index');
Route::get('/export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');
//Route::get('/export_excel/excel', 'ExportExcelController@excel');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
