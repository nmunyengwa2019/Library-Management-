<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\AuthorsController;
//use App\Http\Controllers\ImportsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/imports','App\Http\Controllers\ImportsController@store')->middleware('auth');
Route::group(['middleware'=>'auth'], function(){
    Route::resources([
    'books'=>BooksController::class,
    'authors'=> AuthorsController::class
]);
});

Route::post('/checkout/{book}','App\Http\Controllers\BookCheckoutController@store')->middleware('auth');

Route::post('/checkin/{book}','App\Http\Controllers\BookCheckinController@store')->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
