<?php

use Illuminate\Support\Facades\Route;

// ===============================
// Controller imports
// ===============================
use App\Http\Controllers\TopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController as UserNewsController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\HolidayController;
use App\Models\Holiday;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Auth\LoginController;

// ===============================
// TOP
// ===============================
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
Route::get('/access', fn () => view('access'));


// ===============================
// 予約フォーム（Reservation / ユーザー側）
// ===============================

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
// API：休業日取得（予約フォーム用）
// ===============================
Route::get('/api/holidays', function () {
    return Holiday::orderBy('date')
        ->pluck('date')
        ->values();
});



    

// ===============================
// お問い合わせ（Contact / ユーザー側）
// ===============================

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

// 一覧表示
Route::get('/news', [UserNewsController::class, 'index'])
    ->name('news.index');

// 詳細表示
Route::get('/news/{id}', [UserNewsController::class, 'show'])
    ->name('news.show');


// ===============================
// 管理側：ログイン（auth / Admin）
// ===============================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


// ===============================
// 管理側：共通（Admin）
// ===============================
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        // 管理TOP
        Route::get('/', function () {
            return view('admin.index');
        })->name('index');

        // ===============================
        // 管理側：予約管理
        // ===============================
        Route::get('/reservation', [AdminReservationController::class, 'index'])
            ->name('reservation.index');

        Route::get('/reservation/csv', [AdminReservationController::class, 'exportCsv'])
            ->name('reservation.csv');

        Route::patch(
            '/reservation/{reservation}/status',
            [AdminReservationController::class, 'updateStatus']
        )->name('reservation.updateStatus');

        Route::delete(
            '/reservation/{reservation}',
            [AdminReservationController::class, 'destroy']
        )->name('reservation.destroy');

        // ===============================
        // 管理側：お知らせ
        // ===============================
        Route::get('/news', [NewsController::class, 'index'])
            ->name('news.index');

        Route::get('/news/create', [NewsController::class, 'create'])
            ->name('news.create');

        Route::post('/news/confirm', [NewsController::class, 'confirm'])
            ->name('news.confirm');

        Route::post('/news/store', [NewsController::class, 'store'])
            ->name('news.store');

        Route::get('/news/complete', [NewsController::class, 'complete'])
            ->name('news.complete');

        Route::get('/news/{id}/edit', [NewsController::class, 'edit'])
            ->name('news.edit');

        Route::post('/news/{id}/update', [NewsController::class, 'update'])
            ->name('news.update');

        Route::post('/news/{id}/delete', [NewsController::class, 'delete'])
            ->name('news.delete');

        // ===============================
        // 管理側：休業日設定
        // ===============================
        Route::get('/holiday', [HolidayController::class, 'index'])
            ->name('holiday.index');

        Route::get('/holiday/create', [HolidayController::class, 'create'])
            ->name('holiday.create');

        Route::post('/holiday/store', [HolidayController::class, 'store'])
            ->name('holiday.store');

        Route::post('/holiday/{holiday}/update', [HolidayController::class, 'update'])
            ->name('holiday.update');

        Route::post('/holiday/{holiday}/delete', [HolidayController::class, 'destroy'])
            ->name('holiday.delete');

        // ===============================
        // 管理側：お問い合わせ管理
        // ===============================
        Route::get('/contacts', [AdminContactController::class, 'index'])
            ->name('contacts.index');

        Route::patch('/contacts/{contact}/status', [AdminContactController::class, 'updateStatus'])
            ->name('contacts.updateStatus');

        Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])
            ->name('contacts.destroy');
    });
