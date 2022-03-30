<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['uses' => 'Id3EditorController@index', 'as' => 'home.index']);
Route::post('/music/update-tags', ['uses' => 'Id3EditorController@updateTags', 'as' => 'update.tags']);