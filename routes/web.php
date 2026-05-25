<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// ── Ziyaretçi Sayfaları ───────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/hakkimizda', [AboutController::class, 'index'])->name('hakkimizda');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri');
Route::get('/rezervasyon', [ReservationController::class, 'index'])->name('rezervasyon');
Route::post('/rezervasyon', [ReservationController::class, 'store'])->name('rezervasyon.store');
Route::get('/iletisim', [ContactController::class, 'index'])->name('iletisim');
Route::post('/iletisim', [ContactController::class, 'store'])->name('iletisim.store');

Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['tr', 'en', 'es', 'ar', 'ru'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('lang.switch');

// ── Admin Panel ────────────────────────────────────────────────────────────────
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Menü Kategorileri
    Route::get('/menu-kategoriler', [AdminController::class, 'menuCategories'])->name('menu.categories');
    Route::post('/menu-kategoriler', [AdminController::class, 'storeCat'])->name('menu.categories.store');
    Route::patch('/menu-kategoriler/{category}', [AdminController::class, 'updateCat'])->name('menu.categories.update');
    Route::delete('/menu-kategoriler/{category}', [AdminController::class, 'destroyCat'])->name('menu.categories.destroy');

    // Menü Öğeleri
    Route::get('/menu-urunler', [AdminController::class, 'menuItems'])->name('menu.items');
    Route::post('/menu-urunler', [AdminController::class, 'storeItem'])->name('menu.items.store');
    Route::patch('/menu-urunler/{item}', [AdminController::class, 'updateItem'])->name('menu.items.update');
    Route::delete('/menu-urunler/{item}', [AdminController::class, 'destroyItem'])->name('menu.items.destroy');
    Route::post('/menu-urunler/{item}/toggle', [AdminController::class, 'updateItemStatus'])->name('menu.items.toggle');

    // Rezervasyonlar
    Route::get('/rezervasyonlar', [AdminController::class, 'reservations'])->name('reservations');
    Route::patch('/rezervasyonlar/{reservation}', [AdminController::class, 'updateReservation'])->name('reservations.update');
    Route::delete('/rezervasyonlar/{reservation}', [AdminController::class, 'destroyReservation'])->name('reservations.destroy');

    // Mesajlar
    Route::get('/mesajlar', [AdminController::class, 'messages'])->name('messages');
    Route::delete('/mesajlar/{message}', [AdminController::class, 'destroyMessage'])->name('messages.destroy');

    // Galeri
    Route::get('/galeri', [AdminController::class, 'gallery'])->name('gallery');
    Route::post('/galeri', [AdminController::class, 'storeGallery'])->name('gallery.store');
    Route::delete('/galeri/{galleryImage}', [AdminController::class, 'destroyGallery'])->name('gallery.destroy');
});

// Auth routes (Breeze)
require __DIR__.'/auth.php';
