<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProfileController;

Auth::routes();
Route::get('/', [DashboardController::class, 'index']);

Route::get('lang/{locale}', function ($locale) {
    $allowedLocales = [
        'en', 'ar', 'bn', 'ca', 'de', 'es', 'fa', 'fr', 'hr', 'hu', 
        'id', 'it', 'ja', 'la', 'nl', 'pl', 'pt-br', 'pt-pt', 'ru', 
        'sk', 'sr', 'tr', 'uk', 'vi', 'zh-CN'
    ];

    if (in_array($locale, $allowedLocales)) {
        session()->put('locale', $locale);
    }
    
    return redirect()->back();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});