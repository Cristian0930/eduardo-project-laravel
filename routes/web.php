<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShowAssets;
use App\Http\Livewire\ShowCategories;
use App\Http\Livewire\ShowStatuses;
use App\Http\Livewire\ShowUsers;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', ShowAssets::class)->name('dashboard');
Route::middleware(['auth:sanctum', 'admin'])->get('/categories', ShowCategories::class)->name('categories');
Route::middleware(['auth:sanctum', 'admin'])->get('/statuses', ShowStatuses::class)->name('statuses');
Route::middleware(['auth:sanctum', 'admin'])->get('/users', ShowUsers::class)->name('users');


