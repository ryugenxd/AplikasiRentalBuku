<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogsController;
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

Route::get('/', [PublicController::class,'index'])->name('public_views');

Route::middleware('only.guest')->group(function(){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'login_authentication'])->name('login.authentication');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'register_authentication'])->name('register.authentication');
});

Route::middleware("auth")->group(function(){


    Route::middleware("only.admin")->group(function(){
        Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

        Route::get('/users',[UserController::class,'index'])->name('users');
        Route::put('/users/restore/{slug}',[UserController::class,'restore'])->name('users.restore');
        Route::get('/users/disapproved',[UserController::class,'disapproved'])->name('users.disapproved');
        Route::put('/users/approved/{slug}',[UserController::class,'approved'])->name('users.approved');
        Route::post('/users/add',[UserController::class,'add'])->name('users.add');
        Route::get('/users/update/{slug}',[UserController::class,'profile'])->name('users.update');
        Route::put('/users/update',[UserController::class,'updated'])->name('users.updated');
        Route::get('/users/banned',[UserController::class,'deleted'])->name('users.deleted');
        Route::delete('/users/ban/{slug}',[UserController::class,'delete'])->name('users.delete');

        Route::get('/logs',[LogsController::class,'index'])->name('logs');
        
        Route::get('/categories',[CategoryController::class,'index'])->name('categories');
        Route::get('/categories/create',[CategoryController::class,'add'])->name('categories.create');
        Route::get('/categories/deleted',[CategoryController::class,'deleted'])->name('categories.deleted');
        Route::get('/categories/update/{slug}',[CategoryController::class,'edit'])->name('categories.update');
        Route::post('/categories/created',[CategoryController::class,'create'])->name('categories.created');
        Route::put('/categories/restore/{slug}',[CategoryController::class,'restore'])->name('categories.restore');
        Route::put('/categories/update',[CategoryController::class,'update'])->name('categories.updated');
        Route::delete('/categories/delete/{slug}',[CategoryController::class,'delete'])->name('categories.delete');
        
        Route::get('/books',[BookController::class,'index'])->name('books');
        Route::get('/books/return',[BookController::class,'returnBook']) -> name('books.return');
        Route::post('/books/return',[BookController::class,'returnStore']) -> name('books.return.store');
        Route::get('/books/rent',[BookController::class,'rentBooks'])->name('books.rent');
        Route::post('/books/rent',[BookController::class,'rentStore'])->name('books.rent.store');
        Route::get('/books/create',[BookController::class,'add'])->name('books.create');
        Route::post('/books/created',[BookController::class,'created'])->name('books.created');
        Route::get('/books/update/{slug}',[BookController::class,'edit'])->name('books.update');
        Route::put('/books/updated',[BookController::class,'update'])->name('books.updated');
        Route::get('/books/deleted',[BookController::class,'deleted'])->name('books.deleted');
        Route::put('/books/restore/{slug}',[BookController::class,'restore'])->name('books.restore');
        Route::delete('/books/delete/{slug}',[BookController::class,'delete'])->name('books.delete');

    });

    Route::get('/profile',[UserController::class,'profile'])->name('profile');
    Route::post('/book/rentnow',[BookController::class,''])->name('rentnow');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});
