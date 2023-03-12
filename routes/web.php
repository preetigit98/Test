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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\RegisterController::class, 'index'])->name('home');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'RegisterUser'])->name('register');
Route::post('/checkemailexits', [App\Http\Controllers\RegisterController::class, 'checkemailexits'])->name('checkemailexits');
Route::post('/Registerstore', [App\Http\Controllers\RegisterController::class, 'Registerstore'])->name('Registerstore');


Route::get('/Scanqrcode', [App\Http\Controllers\RegisterController::class, 'Scanqrcode'])->name('Scanqrcode');
Route::get('/login', [App\Http\Controllers\RegisterController::class, 'login'])->name('login');
Route::post('/loginpost', [App\Http\Controllers\RegisterController::class, 'loginpost'])->name('loginpost');
Route::get('/getdetails/{id}', [App\Http\Controllers\RegisterController::class, 'getdetails']);
Route::post('/logout', [App\Http\Controllers\RegisterController::class, 'logout'])->name('logout');

Route::post('editDetails', [App\Http\Controllers\RegisterController::class, 'editDetails'])->name('editDetails');
