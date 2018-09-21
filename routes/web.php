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

Route::get('/', 'InstagramController@redirectToInstagram');
Route::get('/dashboard', 'InstagramController@dashboard');
Route::get('/instagram/callback', 'InstagramController@callback');