<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');

});

Route::group(['middleware' => 'api','prefix' => 'page'], function ($router) {
    Route::post('create', 'PageController@store');
    Route::post('{pageId}/attach-post', 'PostController@page_attach_post');
    //Route::get('profile', 'JWTAuthController@profile');

});

Route::group(['middleware' => 'api','prefix' => 'follow'], function ($router) {
    Route::post('person/{personId}', 'FollowController@follow_person');
    Route::post('page/{pageId}', 'FollowController@follow_page');
    //Route::get('profile', 'JWTAuthController@profile');

});

Route::group(['middleware' => 'api','prefix' => 'person'], function ($router) {
    Route::post('attach-post', 'PostController@person_attach_post');
    Route::post('feed', 'PostController@feed');
    //Route::post('page/{pageId}', 'FollowController@follow_page');
    //Route::get('profile', 'JWTAuthController@profile');

});