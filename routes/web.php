<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/make-request', 'RequestController@requestview');
Route::get('/view-request', 'RequestController@viewrequest');
Route::post('/send-request', 'RequestController@sendrequest');    
Route::get('disapprove-request/{id}', 'RequestController@disapprove');
Route::get('approve-request/{id}', 'RequestController@updatestatus');
Route::get('fulfilled/{id}', 'RequestController@updatestatus');
