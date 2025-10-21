<?php

use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController as frontDonorController;



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// اختبار النسخة
Route::get('/', [HomepageController::class,'index']);
// ====================
// الصفحات العامة
// ====================
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/causes', [PageController::class, 'causes'])->name('causes');



// ====================
// العائلات (Families)
// ====================
Route::resource('families', FamilyController::class);
Route::get('/families/{id}/show', [FamilyController::class, 'show'])->name('families.show');
Route::get('/donor/{id}/show', [frontDonorController::class, 'show'])->name('donor.show');

// ====================
// الأخبار (News)
// ====================
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::resource('dashboard/news', NewsController::class)->except(['index', 'show']);

// ====================
// البحث
// ====================
Route::get('/search', [SearchController::class, 'search'])->name('search');

// ====================
// التواصل (Contact)
// ====================
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// ====================
// التبرعات (Donations)
// ====================
Route::get('/donate', [DonationController::class, 'quick'])->name('donations.quick');
Route::get('/donate/{id}', [DonationController::class, 'create'])->name('donations.create');
Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');



use App\Http\Controllers\WalletController;

Route::middleware(['auth'])->group(function () {
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/deposit', [WalletController::class, 'depositForm'])->name('wallet.depositForm');
    Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::get('/wallet/withdraw', [WalletController::class, 'withdrawForm'])->name('wallet.withdrawForm');
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    // إدارة العائلات
    Route::resource('families', App\Http\Controllers\Admin\FamilyController::class);
    // Route::get('/families/{family}/edit', [App\Http\Controllers\Admin\FamilyController::class, 'edit'])->name('families.edit');
    // Route::put('/families/{family}', [App\Http\Controllers\Admin\FamilyController::class, 'update'])->name('families.update');
    // Route::delete('/families/{family}', [App\Http\Controllers\Admin\FamilyController::class, 'destroy'])->name('families.destroy');

    // إدارة المتبرعين
    Route::resource('donors', App\Http\Controllers\Admin\DonorController::class);

    // Route::get('/donors', [App\Http\Controllers\Admin\DonorController::class, 'index'])->name('donors.index');
    // Route::delete('/donors/{donor}', [App\Http\Controllers\Admin\DonorController::class, 'destroy'])->name('donors.destroy');
});

// Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
// });
