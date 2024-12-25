<?php

use App\Http\Controllers\BrevoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BrevoController::class,'showNewsletterForm'])->name('brevo.showNewsletterForm');
Route::post('/add-to-newsletter', [BrevoController::class,'addNewsletterContact'])->name('brevo.addNewsletterContact');