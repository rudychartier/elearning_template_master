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

Route::get('/', 'MainController@home')->name('main.home');


Auth::routes();
Route::get('/logout',function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');

})->name('logout');

/**
 * Courses
 */

Route::get ('/courses', 'CoursesController@courses')->name('courses.index');

Route::get ('/courses/{slug}', 'CoursesController@course')->name('courses.show');

Route::get ('/courses/category/{id}', 'CoursesController@filter')->name('courses.filter');

/**
 * Vue formateur 
 */

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/instructor/overview', 'InstructorController@index')->name('instructor.index');

Route::get('/instructor/new', 'InstructorController@create')->name('instructor.create');

Route::post('/instructor/store', 'InstructorController@store')->name('instructor.store');

Route::get('/instructor/courses/{id}/edit', 'InstructorController@edit')->name('instructor.edit');

Route::put('/instructor/courses/{id}/update', 'InstructorController@update')->name('instructor.update');

Route::get('/instructor/courses/{id}/destroy', 'InstructorController@destroy')->name('instructor.destroy');

Route::get('/instructor/courses/{id}/publish', 'InstructorController@publish')->name('instructor.publish');

Route::get('/instructor/courses/{id}/participants', 'InstructorController@participants')->name('instructor.participants');



/**
 * Tarification
 */
Route::get('/instructor/courses/{id}/pricing', 'PricingController@pricing')->name('pricing.index');

Route::post('/instructor/courses/{id}/pricing/store', 'PricingController@store')->name('pricing.store');

/**
 * Plan de cours
 */

Route::get('/instructor/courses/{id}/curriculum', 'CurriculumController@index')->name('instructor.curriculum.index');

Route::get('/instructor/courses/{id}/curriculum/add', 'CurriculumController@create')->name('instructor.curriculum.create');

Route::post('/instructor/courses/{id}/curriculum/store', 'CurriculumController@store')->name('instructor.curriculum.store');

Route::get('/instructor/courses/{id}/curriculum/{section}/edit', 'CurriculumController@edit')->name('instructor.curriculum.edit');

Route::put('/instructor/courses/{id}/curriculum/{section}/update', 'CurriculumController@update')->name('instructor.curriculum.update');

Route::get('/instructor/courses/{id}/curriculum/{section}/destroy', 'CurriculumController@destroy')->name('instructor.curriculum.destroy');

/**
 * Cart
 */

Route::get('/cart', 'CartController@index')->name('cart.index');

Route::get('/cart/{id}/store', 'CartController@store')->name('cart.store');

Route::get('/cart/{id}/destroy', 'CartController@destroy')->name('cart.destroy');

Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');

/*
* WishList
*/

Route::get('/wishlist/{id}/store', 'WishListController@store')->name('wishlist.store');

Route::get('/wishlist/{id}/destroy', 'WishListController@destroy')->name('wishlist.destroy');

Route::get('/wishlist/{id}/switch', 'WishListController@toCart')->name('wishlist.toCart');

Route::get('/cart/{id}/switch', 'WishListController@toWishList')->name('cart.toWishList');

/**
 * Checkout
 */

 Route::get('/checkout','CheckoutController@checkout')->name('checkout.payment');

 Route::post('/checkout/charge','CheckoutController@charge')->name('checkout.charge');

 Route::get('/checkout/success','CheckoutController@success')->name('checkout.success');

 /**
  * Vue Participant
  */

  Route::get('/participant/courses','ParticipantController@index')->name('participant.index');

  Route::get('/participant/courses/{slug}','ParticipantController@show')->name('participant.show');

  Route::get('/participant/courses/{slug}/{section}','ParticipantController@section')->name('participant.section');