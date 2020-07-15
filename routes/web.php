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

Route::get('/', 'ClubController@index')->name('club.index');
Route::resource('clubs', 'ClubController')->only(['show','store']);
Route::get('clubs/delete/{club}', 'ClubController@destroy')->name('clubs.destroy');

Route::post('affiliates/{club}', 'AffiliateController@store')->name('affiliates.store');
Route::get('affiliates/delete/{affiliates}/{club}', 'AffiliateController@destroy')->name('affiliates.destroy');
Route::get('affiliates/get/','AffiliateController@autoCompleteAffiliates')->name('affiliates.get');
