<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::view('/about', 'other.about')->name('about');
    Route::view('/privacy', 'other.privacy')->name('privacy');
    Route::view('/terms', 'other.terms')->name('terms');

    Route::middleware(['auth'])->group(function () {

        Route::resource('posts', PostController::class)->except('index');
        Route::delete('posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
        Route::get('/my-posts', [PostController::class, 'posts'])->middleware(['auth', 'verified'])->name('my-posts');
        Route::get('/search', [PostController::class, 'search'])->name('search');

        Route::resource('comments', CommentController::class)->except('index');

        Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::patch('/profile/{user}', [ProfileController::class, 'role'])->name('profile.role');

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('admin')->name('admin.dashboard');
        Route::get('/admin/category', [DashboardController::class, 'category'])->middleware('admin')->name('admin.category');
        Route::get('/admin/gender', [DashboardController::class, 'gender'])->middleware('admin')->name('admin.gender');
        Route::get('/admin/posts', [DashboardController::class, 'posts'])->middleware('admin')->name('admin.posts');
        Route::get('/admin/reciclebin', [DashboardController::class, 'reciclebin'])->middleware('admin')->name('admin.reciclebin');

        Route::view('/contact', 'other.contact')->name('contact');
        Route::post('send-email', [EmailController::class, 'index'])->name('send-email');

    });

    require __DIR__ . '/auth.php';
});