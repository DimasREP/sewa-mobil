<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MessageController;

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('homepage');
Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('homepage');
Route::get('contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('contact', [\App\Http\Controllers\HomeController::class, 'contactStore'])->name('contact.store');
Route::get('detail', [\App\Http\Controllers\HomeController::class, 'detail'])->name('detail');
// Route::get('/cars/{id}', 'CarController@show')->name('cars.show');


Route::get('admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
Route::resource('admin/cars', \App\Http\Controllers\Admin\CarController::class);
Route::put('admin/cars/update-image/{id}', [\App\Http\Controllers\Admin\CarController::class, 'updateImage'])->name('admin.cars.updateImage');
Route::get('messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.message.index');
Route::delete('messages/{message}', [MessageController::class, 'destroy']) ->name('admin.messages.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   

// Auth::routes();

