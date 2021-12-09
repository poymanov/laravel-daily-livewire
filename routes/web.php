<?php

use App\Http\Controllers\DropdownController;
use App\Http\Controllers\MultiplyInputController;
use App\Http\Controllers\ProductController;
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

Route::view('/', 'welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');
    Route::resource('products', ProductController::class)->except(['store', 'update', 'destroy']);

    Route::group(['prefix' => 'dropdown', 'as' => 'dropdown.'], function () {
        Route::get('', [DropdownController::class, 'form'])->name('form');
        Route::post('', [DropdownController::class, 'submit'])->name('submit');
    });

    Route::group(['prefix' => 'multiply-input', 'as' => 'multiply-input.'], function () {
        Route::get('', [MultiplyInputController::class, 'form'])->name('form');
        Route::post('', [MultiplyInputController::class, 'submit'])->name('submit');
    });
});

require __DIR__ . '/auth.php';
