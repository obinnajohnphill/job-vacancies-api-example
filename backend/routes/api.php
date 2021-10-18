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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::get( '/list_vacancies', 'App\Http\Controllers\JobController@listVacancies')->name('list-jobs');
    Route::post( '/add_vacancy', 'App\Http\Controllers\JobController@addVacancy')->name('add-job');
    Route::post( '/update_vacancy', 'App\Http\Controllers\JobController@updateVacancy')->name('update-job');
    Route::post( '/delete_vacancy', 'App\Http\Controllers\JobController@deleteVacancy')->name('list-job');
    Route::get( '/filter_vacancy', 'App\Http\Controllers\JobController@filterVacancy')->name('search-job');
});
