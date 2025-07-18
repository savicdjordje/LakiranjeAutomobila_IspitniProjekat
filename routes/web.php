<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    \App\Http\Middleware\CheckRole::class . ':admin:employee'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->prefix('/')->group(function () {
    Route::controller(ServiceController::class)->name('client.services.')->group(function () {
        Route::get('/schedule', 'create')->name('create');
        Route::post('/schedule', 'store')->name('store');
        Route::get('/my-services', 'client_index')->name('index');
        Route::get('/my-services/{service}/invoice', 'invoice')->name('invoice');
    });
});

Route::middleware([\App\Http\Middleware\CheckRole::class . ':admin:employee'])->prefix('/')->group(function () {
    Route::controller(ServiceController::class)->name('employee.services.')->group(function () {
        Route::get('/services', 'employee_index')->name('index');
        Route::get('/services/{service}', 'edit')->name('edit');
        Route::post('/services/{service}/status', 'updateStatus')->name('status');
        Route::post('/services/{service}/bill', 'storeBill')->name('bill');
    });
});
