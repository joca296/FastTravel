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

Route::get('/', 'OfferController@index');
Route::get('/offers', 'OfferController@index');
Route::post('/offers', 'OfferController@search');
Route::get('/offers/{id}', 'OfferController@show');
Route::post('/filterLocations','LocationController@filter');

Route::get('/contact','ContactController@index');
Route::post('/contact','ContactController@submit');

Route::get('/survey','SurveyController@create');

Route::get('/about','PageController@about');

Route::get('/register','UserController@create');
Route::post('/register','UserController@store');
Route::get('/validate/{key}','UserController@validateUser');

Route::post('/user/login','UserController@login');

Route::get('/validatePasswordChange/{key}','PasswordUpdateController@validateUpdate');
Route::get('/validateEmailChange/{key}','EmailUpdateController@validateUpdate');
Route::get('/validateUserDelete/{key}','UserController@validateDelete');

Route::group(['middleware'=>['auth']],function (){
    Route::post('/reserve/{id}','ReservationController@store');
    Route::get('/user/reservations','ReservationController@index');
    Route::get('/user/reservations/cancel/{id}','ReservationController@destroy');

    Route::post('/survey','SurveyController@submit');

    Route::get('user/delete','UserController@delete');

    Route::post('/user/logout','UserController@logout');
    Route::get('/user/dashboard','UserController@index');
    Route::get('/user/changePassword','PasswordUpdateController@edit');
    Route::post('/user/changePassword','PasswordUpdateController@update');
    Route::get('/user/changeEmail','EmailUpdateController@edit');
    Route::post('/user/changeEmail','EmailUpdateController@update');
});

Route::group(['middleware'=>['auth.admin']],function (){
    Route::get('/admin','OfferController@indexTable');
    Route::get('/offers/delete/{id}','OfferController@destroy');
    Route::get('/admin/insert/offer','OfferController@create');
    Route::post('/admin/insert/offer','OfferController@store');
    Route::get('/offers/edit/{id}','OfferController@edit');
    Route::post('/offers/edit/{id}','OfferController@update');

    Route::get('/admin/slides','SlideController@index');
    Route::get('/slides/delete/{id}','SlideController@destroy');
    Route::get('/admin/insert/slide','SlideController@create');
    Route::post('/admin/insert/slide','SlideController@store');
    Route::get('/slides/edit/{id}','SlideController@edit');
    Route::post('/slides/edit/{id}','SlideController@update');

    Route::get('/admin/locations','LocationController@index');
    Route::get('/locations/delete/{id}','LocationController@destroy');
    Route::get('/admin/insert/location','LocationController@create');
    Route::post('/admin/insert/location','LocationController@store');
    Route::get('/locations/edit/{id}','LocationController@edit');
    Route::post('/locations/edit/{id}','LocationController@update');

    Route::get('/admin/countries','CountryController@index');
    Route::get('/countries/delete/{id}','CountryController@destroy');
    Route::get('/admin/insert/country','CountryController@create');
    Route::post('/admin/insert/country','CountryController@store');
    Route::get('/countries/edit/{id}','CountryController@edit');
    Route::post('/countries/edit/{id}','CountryController@update');

    Route::get('/admin/surveyResults','SurveyController@index');
});
