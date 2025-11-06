<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\DonorController as FrontDonorController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FamilyController as AdminFamilyController;
use App\Http\Controllers\Admin\NewssController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================
// المصادقة (Auth)
// ====================
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ====================
// الصفحة الرئيسية
// ====================
Route::get('/', [HomepageController::class, 'index'])->name('home');

// ====================
// الصفحات العامة
// ====================
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/causes', [PageController::class, 'causes'])->name('causes');

// ====================
// العائلات (Families)
// ====================
// ✅ تم توحيد الإنشاء والتعديل في نفس الصفحة
Route::resource('families', FamilyController::class);

// ====================
// المتبرعين (Donors)
// ====================
Route::get('/donor/{id}/show', [FrontDonorController::class, 'show'])->name('donor.show');

// ====================
// الأخبار (News)
// ====================
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::resource('dashboard/news', NewsController::class)->except(['index', 'show']);
Route::get('/news', [NewsController::class, 'all'])->name('news.index');
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('news', NewsController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Resource route لأخبار الـ admin
    Route::resource('news', NewssController::class);
});


// ====================
// البحث (Search)
// ====================
Route::get('/search', [SearchController::class, 'search'])->name('search');

// ====================
// التواصل (Contact)
// ====================
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/messages', [ContactController::class, 'index'])->name('messages.index');
    Route::get('/admin/messages/{id}', [ContactController::class, 'show'])->name('messages.show');
    Route::delete('/admin/messages/{id}', [ContactController::class, 'destroy'])->name('messages.destroy');
});

// ====================
// التبرعات (Donations)
// ====================
Route::get('/donate', [DonationController::class, 'quick'])->name('donations.quick');
Route::get('/donate/{id}', [DonationController::class, 'create'])->name('donations.create');
Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');

// ====================
// المحفظة (Wallet)
// ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/deposit', [WalletController::class, 'depositForm'])->name('wallet.depositForm');
    Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::get('/wallet/withdraw', [WalletController::class, 'withdrawForm'])->name('wallet.withdrawForm');
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');
});

// ====================
// لوحة التحكم (Admin Panel)
// ====================
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // لوحة التحكم
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // إدارة العائلات
        Route::resource('families', AdminFamilyController::class);

        // إدارة المتبرعين
        Route::resource('donors', DonorController::class);
    });
  use App\Http\Controllers\FamilyAIController;

Route::get('/families/priority', [FamilyAIController::class, 'priorityScores']);
Route::get('/families/alerts', [FamilyAIController::class, 'smartAlerts']);

Route::get('/admin/ai', [FamilyAIController::class, 'adminAIView']);
Route::get('/admin/ai', [FamilyAIController::class, 'adminAIView']); // الصفحة
Route::get('/admin/ai-data', [FamilyAIController::class, 'adminAIData']); // البيانات
Route::prefix('admin')->name('admin.')->group(function () {
    // Families CRUD
    // Route::resource('families', FamilyController::class);

    // News CRUD
    Route::resource('news', NewsController::class);
});
