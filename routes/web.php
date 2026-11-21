<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;

// Customer Front Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/story', [HomeController::class, 'story'])->name('story');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/events-promos', [HomeController::class, 'promos'])->name('promos');
Route::get('/reservation', [HomeController::class, 'reservation'])->name('reservation');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// Redirect legacy /login routes to Filament Admin Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
