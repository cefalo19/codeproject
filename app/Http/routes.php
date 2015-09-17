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

Route::resource('clients', 'ClientController',  ['except' => ['create', 'edit']]);
Route::resource('projects', 'ProjectController',  ['except' => ['create', 'edit']]);

Route::post('project/{id}/notes', 'ProjectNoteController@store');
Route::put('project/{id}/notes/{noteId}', 'ProjectNoteController@update');
Route::get('project/{id}/notes', 'ProjectNoteController@index');
Route::get('project/{id}/notes/{noteId}', 'ProjectNoteController@show');
Route::delete('project/{id}/notes/{noteId}', 'ProjectNoteController@destroy');

Route::post('project/{id}/tasks', 'ProjectTaskController@store');
Route::put('project/{id}/tasks/{taskId}', 'ProjectTaskController@update');
Route::get('project/{id}/tasks', 'ProjectTaskController@index');
Route::get('project/{id}/tasks/{taskId}', 'ProjectTaskController@show');
Route::delete('project/{id}/tasks/{taskId}', 'ProjectTaskController@destroy');

Route::get('project/{id}/members', 'MemberController@all');
Route::post('project/{id}/members/add', 'MemberController@add');
Route::delete('project/{id}/members/remove', 'MemberController@remove');
Route::get('project/{id}/members/{memberId}/is_member', 'MemberController@isMember');
