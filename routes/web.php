<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    try {
        $collections = \App\Models\Collection::all();
    } catch (\Throwable $e) {
        Log::error('Home route failed to load collections', ['error' => $e->getMessage()]);
        $collections = collect();
    }

    return view('home', compact('collections'));
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Product Routes (all public for testing)
Route::resource('products', ProductController::class);

// Video Routes
Route::get('/videos/upload', function() { return view('videos.upload'); })->name('videos.upload.page');
Route::post('/videos/upload', [VideoController::class, 'upload'])->name('videos.upload');
Route::get('/videos/{id}/stream', [VideoController::class, 'stream'])->name('videos.stream');
Route::get('/videos/{id}/info', [VideoController::class, 'info'])->name('videos.info');
Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');

// Collections Routes
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{collection}/media', [CollectionController::class, 'media'])->name('collections.media');
Route::get('/collections/{slug}', [CollectionController::class, 'show'])->name('collections.show');
Route::post('/collections/update-name', [CollectionController::class, 'updateName'])->name('collections.update-name');

// Cart Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::resource('cart', CartController::class)->except(['create', 'edit']);
    Route::resource('orders', OrderController::class);
});

// Admin Routes (Protected - Admin only)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Collections Management
    Route::get('/collections', [AdminController::class, 'collections'])->name('collections');
    Route::get('/collections/create', [AdminController::class, 'createCollection'])->name('collections.create');
    Route::post('/collections', [AdminController::class, 'storeCollection'])->name('collections.store');
    Route::get('/collections/{collection}/edit', [AdminController::class, 'editCollection'])->name('collections.edit');
    Route::put('/collections/{collection}', [AdminController::class, 'updateCollection'])->name('collections.update');
    Route::delete('/collections/{collection}', [AdminController::class, 'deleteCollection'])->name('collections.delete');
    
    // Products Management
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('products.delete');
});


