<?php

use App\Http\Controllers\DashboardPeranController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OfficeTypeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
});

Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
Route::resource('role', RoleController::class);

Route::get('dashboard-peran', [DashboardPeranController::class, 'index'])->name('dashboard-peran');

Route::post('region/{id}/toggle-status', [RegionController::class, 'toggleStatus'])->name('region.toggleStatus');
Route::resource('region', RegionController::class);

Route::post('office_types/{id}/toggle-status', [OfficeTypeController::class, 'toggleStatus'])->name('office_types.toggleStatus');
Route::resource('office_types', OfficeTypeController::class);

Route::post('office/{id}/toggle-status', [OfficeController::class, 'toggleStatus'])->name('office.toggleStatus');
Route::resource('office', OfficeController::class);
