<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FournisseurResourceController;
use App\Http\Controllers\Web\WebLoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [WebLoginController::class, 'offre'])->name('web.offre');

Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/produit', [ProductController::class, 'index'])->name('admin.produit');
    Route::post('/produit', [ProductController::class, 'store'])->name('admin.produit.store');
    Route::get('/produit/create', [ProductController::class, 'create'])->name('produit.create');
    Route::get('/produit/{id}/edit', [ProductController::class, 'edit'])->name('admin.produit.edit');
    Route::put('/produit/{id}', [ProductController::class, 'update'])->name('admin.produit.update');
    Route::delete('/produit/{id}', [ProductController::class, 'destroy'])->name('produit.destroy');
    
    Route::get('/fournisseur', [FournisseurResourceController::class, 'index'])->name('admin.fournisseur');
    Route::get('/fournisseur/create', [FournisseurResourceController::class, 'create'])->name('admin.fournisseur.create');
    Route::post('/fournisseur', [FournisseurResourceController::class, 'store'])->name('admin.fournisseur.store');
    Route::get('/fournisseur/{id}/edit', [FournisseurResourceController::class, 'edit'])->name('admin.fournisseur.edit');
    Route::put('/fournisseur/{id}', [FournisseurResourceController::class, 'update'])->name('admin.fournisseur.update');   
    Route::delete('/fournisseur/{id}', [FournisseurResourceController::class, 'destroy'])->name('admin.fournisseur.destroy');
    
    Route::get('/AdminDashboard', [AdminController::class, 'dashboard'])->name('AdminDashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});

require __DIR__.'/auth.php';