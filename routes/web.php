<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ve-pumi', [HomeController::class, 'about'])->name('about');
Route::get('/doi-tac', [HomeController::class, 'partners'])->name('partners');
Route::get('/san-pham', [HomeController::class, 'products'])->name('products');
Route::get('/san-pham/{slug}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/tin-tuc', [HomeController::class, 'posts'])->name('posts');
Route::get('/tin-tuc/{slug}', [HomeController::class, 'postDetail'])->name('post.detail');
Route::get('/tuyen-dung', [HomeController::class, 'recruitment'])->name('recruitment');
Route::get('/tuyen-dung/{slug}', [HomeController::class, 'recruitmentDetail'])->name('recruitment.detail');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');

// Dọn dẹp routes cũ của Breeze nếu muốn, nhưng hiện tại cứ ghi đè route '/'


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Quản lý Sản phẩm và Danh mục
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['create', 'edit', 'show']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['create', 'edit', 'show']);
    
    // Quản lý Tin tức
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->except(['create', 'edit', 'show']);
    
    // Upload ảnh từ Editor
    Route::post('upload-image', [\App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('upload.image');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
