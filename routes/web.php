<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::name('admin')->group(function () {
Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
Route::get('/register',[AdminController::class,'register'])->name('admin.register');
Route::get('/login',[AdminController::class,'login'])->name('admin.login');
Route::post('/logout',[AdminController::class,'logout'])->name('admin.logout');
});