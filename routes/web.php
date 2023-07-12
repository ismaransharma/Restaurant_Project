<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;

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

Route::get('/', [SiteController::class, 'getHome'])->name('getHome');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
Route::prefix('admin')->group(function(){
    
    
    
    Route::prefix('hero')->group(function(){
        
        Route::get('manage', [HomeController::class, 'getHeroManage'])->name('getHeroManage');
        
        // Add
        Route::post('add', [HomeController::class, 'postaddHero'])->name('postaddHero');
        
        // Edit Get
        Route::get('edit/{slug}', [HomeController::class, 'getEditHero'])->name('getEditHero');
        
        // Edit
        Route::post('edit/{slug}', [HomeController::class, 'postEditHero'])->name('postEditHero');

        // Delete
        Route::get('delete/{slug}', [HomeController::class, 'getDeleteHero'])->name('getDeleteHero');
    });


    Route::prefix('about-us')->group(function(){

        Route::get('manage', [HomeController::class, 'getAboutUsManage'])->name('getAboutUsManage');

        // Add
        Route::post('add', [HomeController::class, 'postaddAboutUs'])->name('postaddAboutUs');
        
        // Edit Get
        Route::get('edit/{slug}', [HomeController::class, 'getEditAboutUs'])->name('getEditAboutUs');
        
        // Edit
        Route::post('edit/{slug}', [HomeController::class, 'postEditAboutUs'])->name('postEditAboutUs');

        // Delete
        Route::get('delete/{slug}', [HomeController::class, 'getDeleteAboutUs'])->name('getDeleteAboutUs');
    });
});
});