<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberUserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\SuperAdminUserController;
use App\Http\Controllers\UrlController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/member/dashboard', [MemberUserController::class, 'dashboard'])->name('member-dashboard');
    Route::get('/admin/dashboard', [AdminUserController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/super-admin/dashboard', [SuperAdminUserController::class, 'dashboard'])->name('super-admin-dashboard');
    Route::get('/urls/create', [UrlController::class, 'create'])->middleware(['auth', 'block.super.admin']);
    Route::post('/urls', [UrlController::class, 'store']);    
    Route::get('/admin/viewallurl', [AdminUserController::class, 'adminView'])->name('viewall');
    Route::get('/admin/invite', [AdminUserController::class, 'inviteForm'])->name('invite.form');
    Route::post('/admin/invite', [AdminUserController::class, 'sendInvite'])->name('invite.send');
});

Route::get('/s/{short_code}', [UrlController::class, 'redirect']);
