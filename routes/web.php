<?php

use Illuminate\Support\Facades\Route;

// ===============================
// TOP
// ===============================
Route::get('/', function () {
    return view('top');
});

// ===============================
// Menu
// ===============================
Route::get('/menu/food', fn() => view('menu.food'));
Route::get('/menu/drink', fn() => view('menu.drink'));
Route::get('/menu/seasonal', fn() => view('menu.seasonal'));

// access
Route::get('/access', fn() => view('access'));


// ===============================
// お問い合わせ（Contact）
// ===============================
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'form'])->name('contact.form');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');


// ===============================
// 管理側：お知らせ（news）
// ===============================
use App\Http\Controllers\Admin\NewsController;

Route::prefix('admin')->group(function () {

    // 一覧
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');

    // 新規作成 → フォーム
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');

    // 新規作成 → 確認
    Route::post('/news/confirm', [NewsController::class, 'confirm'])->name('admin.news.confirm');

    // 新規作成 → 保存
    Route::post('/news/store', [NewsController::class, 'store'])->name('admin.news.store');

    // 完了画面
    Route::get('/news/complete', [NewsController::class, 'complete'])->name('admin.news.complete');

    // 編集
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::post('/news/{id}/update', [NewsController::class, 'update'])->name('admin.news.update');

    // 削除
    Route::post('/news/{id}/delete', [NewsController::class, 'delete'])->name('admin.news.delete');
});


// ===============================
// ユーザー側：お知らせ一覧＆詳細
// ===============================
use App\Http\Controllers\NewsController as UserNewsController;

Route::get('/news', [UserNewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [UserNewsController::class, 'show'])->name('news.show');
