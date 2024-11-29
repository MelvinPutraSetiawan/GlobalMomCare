<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Route;

// =============================
// INI ROUTING UNTUK SEMUA ORANG
// =============================

// ==================
// HOME ROUTING
// ==================
// Routing Home
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [ArticleController::class, 'getArticles'])->name('home');
// Routing Search Bar + Kategory Di Home
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Routing Buat Read More [Detail Articles]
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

// ==================
// FORUMS ROUTING
// ==================
// Routing Buat Ke Page ==== FORUMS ====
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
// Routing Search Bar + Kategory Di  ==== FORUM ====
Route::get('/forums/search', [ForumController::class, 'search'])->name('forums.search');
// Routing Buat Read More [Detail ==== FORUM ====]
Route::get('/forums/detail/{id}', [ForumController::class, 'show'])->name('forums.show');

// ==================
// PRODUCT ROUTING
// ==================
// Routing Buat ke Page ==== PRODUCT ====
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Routing ke Page PRODUCT DETAIL ==== PRODUCT ====
Route::get('/products/detail/{id}', [ProductController::class, 'show'])->name('products.show');
// Searching Product
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// ==================================
// INI ROUTING GUESS [GA PUNYA AKUN]
// ==================================
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AccountController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AccountController::class, 'register']);
    // Login
    Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AccountController::class, 'login']);
});

// ========================================
// INI ROUTING YG PUNYA ACCOUNT [UDH LOGIN]
// ========================================
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');

    // ==================
    // ARTICLE ROUTING
    // ==================
    // Routing buat create Article [Cuma role "professional" yg bisa access udh di check di home.blade.php]
    Route::get('/articles/new/create', [ArticleController::class, 'create'])->name('articles.new.create');
    // Simpen Article yang baru dibuat
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    // Delete Article
    Route::delete('/articles/delete/{id}', [ArticleController::class, 'delete'])->name('articles.delete');
    // Pindah Ke Update Article Page
    Route::get('/article/update/{id}', [ArticleController::class, 'updatePage'])->name('articles.update.page');
    // Simpen Article yang udh di Update
    Route::put('/article/update/store/{id}', [ArticleController::class, 'update'])->name('articles.update');

    // ==================
    // FORUM ROUTING
    // ==================
    // Routing Untuk Create Forum
    Route::get('/forums/new/create', [ForumController::class, 'create'])->name('forums.new.create');
    // Simpen Forum yang baru dibuat
    Route::post('/forums/store', [ForumController::class, 'store'])->name('forums.store');
    // Delete Forums
    Route::delete('/forums/delete/{id}', [ForumController::class, 'delete'])->name('forums.delete');
    // Pindah ke Update Forum Page
    Route::get('/forums/update/{id}', [ForumController::class, 'updatePage'])->name('forums.update.page');
    // Simpen Forum yang di Update
    Route::put('/forums/update/store/{id}', [ForumController::class, 'update'])->name('forums.update');

    // ==================
    // COMMENT ROUTING
    // ==================
    // Simpen Comment
    Route::post('/comment/store/{id}', [CommentController::class, 'store'])->name('comment.store');
    // Delete Comment [Dari Page Forumnya]
    Route::post('/comment/delete/{id}/{forumid}', [CommentController::class, 'delete'])->name('comment.delete');
    // Delete Comment [Dari Page Profile]
    Route::post('/comment/delete/{id}', [CommentController::class, 'deleteBackProfile'])->name('comment.delete.profile');

    // ==================
    // PROFILE ROUTING
    // ==================
    //Open Profile Page
    Route::get('/profile' ,[AccountController::class, 'profile'])->name('profile.show');

    // ==================
    // PRODUCT ROUTING
    // ==================
    // Pindah ke page Create PRODUCT
    Route::get('/product/new/create', [ProductController::class, 'create'])->name('products.create');
    // Store Product
    Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');
    // Delete Product
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
    // Pindah ke Update Page PRODUCT
    Route::get('/product/update/{id}', [ProductController::class, 'updatePage'])->name('products.update.page');
    // Store Updated Data
    Route::put('/product/update/store/{id}', [ProductController::class, 'update'])->name('products.update');
    // Beli Product [Masukkin ke OrderDetail] ACCESS USING URL (CANNOT USING NAME)
    Route::post('/product/add/cart/{id}', [ProductController::class, 'addCart'])->name('products.cart');

    // =====================
    // CART ROUTING
    // =====================
    // Show all cart
    Route::get('/cart', [CartController::class, 'index'])->name('carts.index');
    // Delete From Cart
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('carts.delete');

    // =====================
    // ORDER ROUTING
    // =====================
    // Add to Order Detail
    Route::post('/order', [OrderDetailController::class, 'store'])->name('orders.store');
    // Ke Payment page
    Route::get('/order/payment/{id}', [OrderDetailController::class, 'payment'])->name('orders.payment');
    // Show Semua Order
    Route::get('/orders', [OrderDetailController::class, 'index'])->name('orders.index');
    // Cancel Order
    Route::post('/order/cancelled/{id}', [OrderDetailController::class, 'cancel'])->name('orders.cancel');
    // Process Payment
    Route::post('/order/process/payment/{id}', [OrderDetailController::class, 'processPayment'])->name('orders.process.payment');
    // Summary Dari Order Habis Bayar
    Route::get('/order/summary/{id}', [OrderDetailController::class, 'summary'])->name('orders.summary');
    // Tracking Order yang udh dibayar
    Route::get('/order/track/{id}', [OrderDetailController::class, 'track'])->name('orders.track');
    // ADMIN PROCESS & DELIVER ORDER
    Route::post('/order/process/deliver/{id}', [OrderDetailController::class, 'processDeliver'])->name('orders.process.deliver');
    // ADMIN COMPLETED ORDER
    Route::post('/order/complete/{id}', [OrderDetailController::class, 'completed'])->name('orders.completed');

});


// CATATAN
// Klo mau pake DELETE method Example: Route::delete
// Di form harus ada "@method('DELETE')
// Note: Klo mau pake post biasa juga ttp jalan

// Klo mau pake PUT (Buat Update) method Example: Route::put
// Di form harus ada "@method('PUT')
// Note: Klo mau pake post biasa juga ttp jalan
