<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * 新規作成 → フォーム表示
     */
    public function create()
    {
        return view('reservation.reservation');
        // ※ resources/views/reservation/reservation.blade.php
    }

    /**
     * 新規作成 → 確認画面
     */
    public function confirm(ReservationRequest $request)
    {
        // バリデーション済みの入力データを取得
        $data = $request->validated();

        // 確認画面へ表示
        return view('reservation.confirm', compact('data'));
    }

    /**
     * 新規作成 → 保存処理
     */
    public function store(Request $request)
    {
        // 確認画面から送信された内容を保存
        Reservation::create($request->all());

        // 完了画面へリダイレクト（PRGパターン）
        return redirect()->route('reservation.complete');
    }
}