<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AdminController;

Route::get('/', [PortalController::class, 'index']);
Route::get('/assignments', [PortalController::class, 'assignments'])->name('assignments.index');
Route::post('/assignments/{id}/submit', [PortalController::class, 'submitAssignment'])->name('submissions.store');

Route::get('/register', [PortalController::class, 'registerForm'])->name('register.form');
Route::post('/register', [PortalController::class, 'registerStore'])->name('register.store');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/assignments', [AdminController::class, 'storeAssignment'])->name('admin.assignments.store');
