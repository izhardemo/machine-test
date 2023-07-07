<?php

use App\Http\Controllers\BallController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\BucketSuggestionController;
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

Route::get('/', [BucketSuggestionController::class, 'create'])->name('home');
Route::post('/bucket-suggestion/store', [BucketSuggestionController::class, 'store'])->name('bucketSuggestion.store');

Route::resource('/buckets', BucketController::class)->except(['show','delete']);
Route::resource('/balls', BallController::class);