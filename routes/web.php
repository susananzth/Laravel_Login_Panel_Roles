<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Countries;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Users;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get   ('/profile', [ProfileController::class, 'edit']   )->name('profile.edit');
    Route::patch ('/profile', [ProfileController::class, 'update'] )->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get   ('/role',    Roles::class                         )->name('roles');
    Route::get   ('/user',    Users::class                         )->name('users');
    Route::get   ('/country', Countries::class                     )->name('countries');
});

require __DIR__.'/auth.php';
