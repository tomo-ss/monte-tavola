<?php

use Illuminate\Support\Facades\Route;

// ===============================
// TOP
// ===============================
use App\Http\Controllers\TopController;

// TOPページ表示
Route::get('/', [TopController::class, 'index'])
    ->name('top');


// ===============================
// Menu
// ===============================

// メニュー：フード
Route::get('/menu/food', fn() => view('menu.food'));

// メニュー：ドリンク
Route::get('/menu/drink', fn() => view('menu.drink'));

// メニュー：季節限定
Route::get('/menu/seasonal', fn() => view('menu.seasonal'));


// ===============================
// Access
// ===============================

// アクセス情報表示
Route::get('/access', fn() => view('access'));


// ===============================
// 予約フォーム（Reservation / ユーザー側）
// ===============================
use App\Http\Controllers\ReservationController;

// 新規作成 → フォーム表示
Route::get('/reservation', [ReservationController::class, 'create'])
    ->name('reservation.create');

// 新規作成 → 確認画面
Route::post('/reservation/confirm', [ReservationController::class, 'confirm'])
    ->name('reservation.confirm');

// 新規作成 → 保存処理
Route::post('/reservation', [ReservationController::class, 'store'])
    ->name('reservation.store');

// 完了画面
Route::get('/reservation/complete', fn () => view('reservation.complete'))
    ->name('reservation.complete');


// ===============================
// お問い合わせ（Contact / ユーザー側）
// ===============================
use App\Http\Controllers\ContactController;

// 新規作成 → フォーム表示
Route::get('/contact', [ContactController::class, 'form'])
    ->name('contact.form');

// 新規作成 → 確認画面
Route::post('/contact/confirm', [ContactController::class, 'confirm'])
    ->name('contact.confirm');

// 新規作成 → 完了画面
Route::post('/contact/complete', [ContactController::class, 'complete'])
    ->name('contact.complete');


// ===============================
// 管理側：お知らせ（News / Admin）
// ===============================
use App\Http\Controllers\Admin\NewsController;

Route::prefix('admin')->group(function () {

    // 一覧表示
    Route::get('/news', [NewsController::class, 'index'])
        ->name('admin.news.index');

    // 新規作成 → フォーム表示
    Route::get('/news/create', [NewsController::class, 'create'])
        ->name('admin.news.create');

    // 新規作成 → 確認画面
    Route::post('/news/confirm', [NewsController::class, 'confirm'])
        ->name('admin.news.confirm');

    // 新規作成 → 保存処理
    Route::post('/news/store', [NewsController::class, 'store'])
        ->name('admin.news.store');

    // 新規作成 → 完了画面
    Route::get('/news/complete', [NewsController::class, 'complete'])
        ->name('admin.news.complete');

    // 編集 → フォーム表示
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])
        ->name('admin.news.edit');

    // 編集 → 更新処理
    Route::post('/news/{id}/update', [NewsController::class, 'update'])
        ->name('admin.news.update');

    // 削除処理
    Route::post('/news/{id}/delete', [NewsController::class, 'delete'])
        ->name('admin.news.delete');
});


// ===============================
// ユーザー側：お知らせ（News / Public）
// ===============================
use App\Http\Controllers\NewsController as UserNewsController;

// 一覧表示
Route::get('/news', [UserNewsController::class, 'index'])
    ->name('news.index');

// 詳細表示
Route::get('/news/{id}', [UserNewsController::class, 'show'])
    ->name('news.show');
