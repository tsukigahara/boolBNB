<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ProfileController;
use App\Models\Apartment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get(
    '/dashboard',
    [ApartmentController::class, function () {
        return Inertia::render('Dashboard/Dashboard');
    }]
)->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/apartments', [ApartmentController::class, 'index'])
        ->name('dashboard.apartments');

    Route::get('/dashboard/apartments/{id}', [ApartmentController::class, 'edit'])
        ->name('dashboard.apartments.edit');

    Route::get('/dashboard/apartments/create', [ApartmentController::class, 'create'])
        ->name('dashboard.apartments.create');

    Route::post('/dashboard/apartments/{id}', [ApartmentController::class, 'update'])
        ->name('dashboard.apartments.update');





    Route::get(
        '/dashboard',
        [ApartmentController::class, function () {
            return Inertia::render('Dashboard/Dashboard');
        }]
    )->name('dashboard');
});
require __DIR__ . '/auth.php';
