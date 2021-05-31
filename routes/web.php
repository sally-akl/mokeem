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

Route::group(['before' => 'auth.basic','prefix'=>'dashboard'],function () {
  Route::get('/',['uses'=>'DashboardController@index']);
  //Route::get('/backup',['uses'=>'DashboardController@backup']);
  Route::get('/download/{ext}/{file}',['uses'=>'DashboardController@download']);

  Route::group(['prefix'=>'mokeem'],function () {
      Route::get('/boy/{type}',['uses'=>'MokeemController@index']);
      Route::get('/girl/{type}',['uses'=>'MokeemController@girl']);
      Route::get('create/{type}',['uses'=>'MokeemController@create']);
      Route::post('/store',['before' => 'csrf','uses'=>'MokeemController@store']);
      Route::get('/{id}/edit',['uses'=>'MokeemController@edit']);
      Route::post('/{id}',['before' => 'csrf','uses'=>'MokeemController@update'])->where('id', '[0-9]+');
      Route::get('index/{id}',['uses'=>'MokeemController@destroy']);
      Route::get('/{id}/show',['uses'=>'MokeemController@show']);
      Route::get('/{id}/family',['uses'=>'MokeemController@family']);
      Route::post('/archive',['before' => 'csrf','uses'=>'MokeemController@archive']);
      Route::get('relation',['uses'=>'MokeemController@relation']);
      Route::post('/save/relation',['before' => 'csrf','uses'=>'MokeemController@save_relation']);
      Route::get('/{id}/{type}/move',['uses'=>'MokeemController@move'])->where('id', '[0-9]+');
      Route::get('/getrelatives/{id}',['uses'=>'MokeemController@getrelatives']);
  });
  Route::group(['prefix'=>'relative'],function () {
      Route::get('/',['uses'=>'RelativeController@index']);
      Route::get('create',['uses'=>'RelativeController@create']);
      Route::post('/store',['before' => 'csrf','uses'=>'RelativeController@store']);
      Route::get('/{id}/edit',['uses'=>'RelativeController@edit']);
      Route::post('/{id}',['before' => 'csrf','uses'=>'RelativeController@update'])->where('id', '[0-9]+');
      Route::get('index/{id}',['uses'=>'RelativeController@destroy']);
  });
  Route::group(['prefix'=>'visit'],function () {
      Route::get('/',['uses'=>'VisitsController@index']);
      Route::get('create',['uses'=>'VisitsController@create']);
      Route::post('/store',['before' => 'csrf','uses'=>'VisitsController@store']);
      Route::get('/{id}/edit',['uses'=>'VisitsController@edit']);
      Route::post('/{id}',['before' => 'csrf','uses'=>'VisitsController@update'])->where('id', '[0-9]+');
      Route::get('index/{id}',['uses'=>'VisitsController@destroy']);
      Route::post('search/all/mokeem',['before' => 'csrf','uses'=>'VisitsController@search_mokeem']);
      Route::post('search/all/relative',['before' => 'csrf','uses'=>'VisitsController@search_relative']);
  });
  Route::group(['prefix'=>'archive'],function () {
      Route::get('/',['uses'=>'ArchiveController@index']);
  });
  Route::group(['prefix'=>'report'],function () {
      Route::get('/{type}',['uses'=>'ReportController@index']);
      Route::get('/visitcount/{type}',['uses'=>'ReportController@visitcount_report']);
      Route::get('/visitmokeem/{type}',['uses'=>'ReportController@visitmokeem_report']);
      Route::get('/relatives/{type}',['uses'=>'ReportController@relatives_report']);
  });
});
Auth::routes();
