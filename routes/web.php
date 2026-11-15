<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Portfolio Routes
|--------------------------------------------------------------------------
*/

Route::get('/',          [PortfolioController::class, 'home'])->name('home');
Route::get('/about',     [PortfolioController::class, 'about'])->name('about');
Route::get('/portfolio', [PortfolioController::class, 'portfolio'])->name('portfolio');
Route::get('/services',  [PortfolioController::class, 'services'])->name('services');
Route::get('/resume',    [PortfolioController::class, 'resume'])->name('resume');
Route::get('/products',  [PortfolioController::class, 'products'])->name('products');
Route::get('/blog',      [PortfolioController::class, 'blog'])->name('blog');
Route::get('/contact',   [PortfolioController::class, 'contact'])->name('contact');

Route::get('/blog/{slug}',  [PortfolioController::class, 'blogShow'])->name('blog.show');
Route::post('/contact',     [PortfolioController::class, 'contactSend'])->name('contact.send');
