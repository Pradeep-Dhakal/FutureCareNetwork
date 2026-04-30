<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ── PUBLIC ────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ── FAMILY REGISTRATION ───────────────────────────────────────────────────
Route::get('/family-register', [FamilyController::class, 'create'])->name('family.register');
Route::post('/family-register', [FamilyController::class, 'store'])->name('family.store');
Route::get('/family-success', fn() => view('public.family-success'))->name('family.success');

// ── FAMILY AUTH ───────────────────────────────────────────────────────────
Route::get('/family/login', [AuthController::class, 'familyLoginForm'])->name('family.login');
Route::post('/family/login', [AuthController::class, 'familyLogin'])->name('family.login.post');
Route::post('/family/logout', [AuthController::class, 'familyLogout'])->name('family.logout');

// ── FAMILY PROTECTED ──────────────────────────────────────────────────────
Route::middleware('auth:family')->group(function () {
    Route::get('/family/dashboard', [AuthController::class, 'familyDashboard'])->name('family.dashboard');
});

// ── EDUCATOR REGISTRATION ─────────────────────────────────────────────────
Route::get('/educator-register', [EducatorController::class, 'create'])->name('educator.register');
Route::post('/educator-register', [EducatorController::class, 'store'])->name('educator.store');
Route::get('/educator-success', fn() => view('public.educator-success'))->name('educator.success');

// ── EDUCATOR AUTH ─────────────────────────────────────────────────────────
Route::get('/educator/login', [AuthController::class, 'educatorLoginForm'])->name('educator.login');
Route::post('/educator/login', [AuthController::class, 'educatorLogin'])->name('educator.login.post');
Route::post('/educator/logout', [AuthController::class, 'educatorLogout'])->name('educator.logout');

// ── EDUCATOR PROTECTED ────────────────────────────────────────────────────
Route::middleware('auth:educator')->group(function () {
    Route::get('/educator/dashboard', [AuthController::class, 'educatorDashboard'])->name('educator.dashboard');
});

// ── ADMIN AUTH ────────────────────────────────────────────────────────────
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// ── ADMIN PROTECTED ───────────────────────────────────────────────────────
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/families', [AdminController::class, 'families'])->name('families');
    Route::patch('/families/{family}/status', [AdminController::class, 'updateFamilyStatus'])->name('families.status');
    Route::delete('/families/{family}', [AdminController::class, 'deleteFamily'])->name('families.delete');

    Route::get('/educators', [AdminController::class, 'educators'])->name('educators');
    Route::patch('/educators/{educator}/status', [AdminController::class, 'updateEducatorStatus'])->name('educators.status');
    Route::delete('/educators/{educator}', [AdminController::class, 'deleteEducator'])->name('educators.delete');

    Route::get('/matches', [AdminController::class, 'matches'])->name('matches');
    Route::post('/matches/run', [MatchController::class, 'runMatching'])->name('matches.run');
    Route::patch('/matches/{careMatch}/status', [MatchController::class, 'updateStatus'])->name('matches.status');
    Route::delete('/matches/{careMatch}', [MatchController::class, 'destroy'])->name('matches.delete');
});