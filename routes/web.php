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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin route
 */
Route::group([ 'as' => 'admin.','prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','admin'] ],function (){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('show/{id}','DashboardController@show')->name('show');
    Route::put('{id}','DashboardController@update')->name('update');
    Route::get('{id}/edit','DashboardController@edit')->name('edit');
    Route::resource('users','UserController');
    Route::resource('u','UserControllerTwo');
    Route::resource('category','CategoryController');
    Route::resource('sub_category','SubCategoryController');
    Route::get('emails','MailController@emails')->name('emails');
    Route::delete('email/{id}','MailController@destroy')->name('email.delete');
    Route::get('email/{id}','MailController@show')->name('email.show');
    Route::get('email/approve/{id}','MailController@approve')->name('approve');
    Route::get('email/decline/{id}','MailController@decline')->name('decline');
});

/**
 * Author route
 */
Route::group([ 'as' => 'author.','prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth','author'] ],function (){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('show/{id}','UserController@show')->name('show');
    Route::put('{id}','UserController@update')->name('update');
    Route::get('{id}/edit','UserController@edit')->name('edit');
    Route::get('emails','MailController@emails')->name('emails');
    Route::get('email/{id}','MailController@show')->name('email.show');
    Route::get('email/approve/{id}','MailController@approve')->name('approve');
    Route::get('email/decline/{id}','MailController@decline')->name('decline');
});
/**
 * Student route
 */
Route::group([ 'as' => 'user.','prefix' => 'user', 'namespace' => 'Student', 'middleware' => ['auth','student'] ],function (){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('show/{id}','UserController@show')->name('show');
    Route::put('{id}','UserController@update')->name('update');
    Route::get('{id}/edit','UserController@edit')->name('edit');
    Route::get('emails','MailController@emails')->name('emails');
    Route::get('email','MailController@index')->name('email.form');
    Route::get('email/get-subcategory-sct','MailController@getSubcategory')->name('subCategory');
    Route::get('email/get-subcategory-sct-id','MailController@getSubcategoryID')->name('subCategoryID');
    Route::post('email/send','MailController@sendmail')->name('email.send');
    Route::get('email/{id}','MailController@show')->name('email.show');
});

Route::group(['as' => 'email.', 'middleware' => ['auth'] ],function (){
    Route::get('email/approve/{id}','MailController@approve')->name('approve');
    Route::get('email/decline/{id}','MailController@decline')->name('decline');
});

Auth::routes(['verify' => true]);