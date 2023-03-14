<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\Apartment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//Welcome page (GUEST ROUTES)

Route::get('/', [ApartmentController::class, 'index'])->name('welcome');

Route::get('show{id}', [ApartmentController::class, 'show'])->name('show');

Route::get('message/create/{id}', [MainController::class, 'messageCreate'])->name('message.create');
Route::post('message/create/{id}', [MainController::class, 'messageStore'])->name('message.store');

//pagina filtro
Route::get('/filtered', [SearchController::class, 'filteredPage'])->name('filteredPage');

//PRIVATE ROUTES
Route::middleware('auth')->group(function () {

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //DASHBOARD////////

    //backoffice apartments
    Route::get('/dashboard/apartments', [DashboardController::class, 'indexMyApartments'])
        ->name('dashboard.apartments');

    Route::get('/dashboard/apartments/create', [ApartmentController::class, 'create'])
        ->name('dashboard.apartments.create');

    Route::post('/dashboard/apartments', [ApartmentController::class, 'store'])
        ->name('dashboard.apartments.store');

    Route::get('/dashboard/apartments/{id}', [ApartmentController::class, 'edit'])
        ->name('dashboard.apartments.edit');

    Route::post('/dashboard/apartments/{id}', [ApartmentController::class, 'update'])
        ->name('dashboard.apartments.update');

    Route::delete('/dashboard/apartments/{id}', [ApartmentController::class, 'destroy'])
        ->name('dashboard.apartments.destroy');

    // MESSAGE
    Route::get('/message/{apartment}', [MainController::class, 'showMessage'])->name('dasbord.apartment.message');

    // VIEW
    Route::get('/view/{apartment}', [MainController::class, 'countView'])->name('dasbord.apartment.view');

    // SPONSORSHIP
    Route::get('/apartment/sponsorship/{apartment}', [MainController::class, 'showSponsorship'])->name('dashbord.apartment.sponsorship');
    Route::post('/apartment/sponsorship/store', [MainController::class, 'storeSposnosrship'])->name('dashbord.apartment.sponsorship.store');


    // Route::get(
    //     '/dashboard',
    //     [ApartmentController::class, function () {
    //         return Inertia::render('Dashboard/Dashboard');
    //     }]
    // )->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::get('/api/geocode/{query}', [SearchController::class, 'geocode'])->name('geocode');
Route::get('/api/apartments/{criteria}/{radius}', [SearchController::class, 'filterApartments'])->name('filterApartments');
Route::get('/api/services', [SearchController::class, 'searchServices']);

Route::get('/payment', [MainController::class, 'payment']) -> name('payment');

require __DIR__ . '/auth.php';
