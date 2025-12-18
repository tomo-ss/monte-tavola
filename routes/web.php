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
Route::get('/menu/food', fn () => view('menu.food'));

// メニュー：ドリンク
Route::get('/menu/drink', fn () => view('menu.drink'));

// メニュー：季節限定
Route::get('/menu/seasonal', fn () => view('menu.seasonal'));


// ===============================
// Access
// ===============================

// アクセス情報表示
Route::get('/access', fn () => view('access'));


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
Route::post('/reservation/store', [ReservationController::class, 'store'])
    ->name('reservation.store');

// 完了画面
Route::get('/reservation/complete', [ReservationController::class, 'complete'])
    ->name('reservation.complete');


// ===============================
// お問い合わせ（Contact / ユーザー側）
// ===============================
use App\Http\Controllers\ContactController;

// フォーム表示
Route::get('/contact', [ContactController::class, 'form'])
    ->name('contact.form');

// 確認画面
Route::post('/contact/confirm', [ContactController::class, 'confirm'])
    ->name('contact.confirm');

// 完了画面
Route::post('/contact/complete', [ContactController::class, 'complete'])
    ->name('contact.complete');


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


// ===============================
// 管理側：TOP（Admin）
// ===============================
Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

});


// ===============================
// 管理側：予約管理（Reservation / Admin）
// ===============================
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;

Route::prefix('admin')->group(function () {
    // CSV出力
    Route::get(
    '/admin/reservation/csv',
    [AdminReservationController::class, 'exportCsv']
    )->name('admin.reservation.csv');

    // 一覧
    Route::get('/reservation', [AdminReservationController::class, 'index'])
        ->name('admin.reservation.index');

    // ステータス切り替え
    Route::post(
        '/reservation/{id}/toggle-status',
        [AdminReservationController::class, 'toggleStatus']
    )->name('admin.reservation.toggle');

});


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
// 仮ログイン（必要になったら使う・今は未使用）
// ===============================
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;

// Route::get('/test-login', function () {
//     Auth::login(User::first());
//     return redirect('/admin');
// });
