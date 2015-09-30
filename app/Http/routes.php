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

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

//Route::group(['middleware' => 'oauth'], function() {

    Route::resource('clients', 'ClientController',  ['except' => ['create', 'edit']]);

    Route::resource('projects', 'ProjectController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'project'], function() {

        Route::post('{id}/notes', 'ProjectNoteController@store');
        Route::put('{id}/notes/{noteId}', 'ProjectNoteController@update');
        Route::get('{id}/notes', 'ProjectNoteController@index');
        Route::get('{id}/notes/{noteId}', 'ProjectNoteController@show');
        Route::delete('{id}/notes/{noteId}', 'ProjectNoteController@destroy');

        Route::post('{id}/tasks', 'ProjectTaskController@store');
        Route::put('{id}/tasks/{taskId}', 'ProjectTaskController@update');
        Route::get('{id}/tasks', 'ProjectTaskController@index');
        Route::get('{id}/tasks/{taskId}', 'ProjectTaskController@show');
        Route::delete('{id}/tasks/{taskId}', 'ProjectTaskController@destroy');

        Route::get('{id}/members', 'MemberController@all');
        Route::post('{id}/members/add', 'MemberController@add');
        Route::delete('{id}/members/remove', 'MemberController@remove');
        Route::get('{id}/members/{memberId}/is_member', 'MemberController@isMember');

        Route::post('{id}/files', 'ProjectFileController@store');
        Route::delete('{id}/files/{fileId}', 'ProjectFileController@destroy');

    });

//});


