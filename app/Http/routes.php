<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('auth/login',['as' => 'google.auth', 'uses' => 'GoogleController@redirectToGoogle']);
Route::get('auth/callback', 'GoogleController@handleGoogleCallback');

Route::group(['middleware' =>'auth'],function(){

    Route::get('/',['as' => 'home', function () {
        return view('pages.index',['mainTitle' => '']);
    }]);

    Route::group(['prefix' => 'forum'],function(){
    Route::get('/',['as' => 'forum',  'uses' => 'ForumController@index']);
    Route::patch('/{id?}',['as' => 'forum.update','uses' => 'ForumController@update']);
    });
    
    Route::group(['prefix' => 'manager'],function(){    
        Route::get('/',['as' => 'manager', 'uses' => 'UsersController@index']);
        Route::post('/store',['as' => 'manager.store','uses' => 'UsersController@store']);
        Route::patch('/{id?}',['as' => 'manager.update','uses' => 'UsersController@update']);
        Route::delete('maager/delete/{id?}',['as' => 'manager.delete','uses' => 'UsersController@destroy']); 
    });

    Route::group(['prefix' => 'log'],function(){
        Route::get('/',['as' => 'log', 'uses' => 'LogsController@index']);
        Route::post('logout',['as' => 'log.out', 'uses' => 'LogsController@update']);
    });

});


