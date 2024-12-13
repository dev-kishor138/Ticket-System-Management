<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TravelRouteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('frontend.home');
// })->name('/');

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/login-page', function () {
    return view('auth.login');
})->name('login');

Route::get('/sign-up', function () {
    return view('auth.sign-up');
})->name('sign.up');

Route::post('/register', [SignUpController::class, 'store']);
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// dashboard reated Route 
Route::controller(DashboardController::class)->group(function () {
    Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
    Route::get('/user/dashboard', 'userDashboard')->name('user.dashboard');
});
// bus related route 
Route::controller(BusController::class)->group(function () {
    Route::get('/bus', 'index')->name('bus');
    Route::get('/bus/view', 'view');
    Route::post('/bus/store', 'store');
    Route::get('/bus/edit/{id}', 'edit');
    Route::post('/bus/update/{id}', 'update');
    Route::get('/bus/delete/{id}', 'delete');
});
// Travel Route related route 
Route::controller(TravelRouteController::class)->group(function () {
    Route::get('/travel-route', 'index')->name('travel.route');
    Route::get('/travel-route/view', 'view');
    Route::post('/travel-route/store', 'store');
    Route::get('/travel-route/edit/{id}', 'edit');
    Route::post('/travel-route/update/{id}', 'update');
    Route::get('/travel-route/delete/{id}', 'delete');
});

// Tickets related route 
Route::controller(TicketController::class)->group(function () {
    Route::get('/ticket', 'index')->name('ticket');
    Route::get('/ticket/view', 'view');
    Route::post('/ticket/store', 'store');
    Route::get('/ticket/edit/{id}', 'edit');
    Route::post('/ticket/update/{id}', 'update');
    Route::get('/ticket/delete/{id}', 'delete');
});
// Purchase related route 
Route::controller(PurchaseController::class)->group(function () {
    // Route::get('/purchase/view', 'view');
    Route::post('/purchase/store', 'store');
    // Route::get('/purchase/edit/{id}', 'edit');
    // Route::post('/purchase/update/{id}', 'update');
    // Route::get('/purchase/delete/{id}', 'delete');
});
