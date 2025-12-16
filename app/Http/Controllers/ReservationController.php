<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * 予約フォーム表示
     */
    public function create()
    {
        return view('reservation.reservation');
    }

    /**
     * 予約内容 確認画面表示
     */
    public function confirm(ReservationRequest $request)
    {
        // バリデーション済みの入力データのみ取得
        $data = $request->validated();

        // 確認画面へデータを渡す
        return view('reservation.confirm', compact('data'));
    }

    /**
     * 予約内容 保存処理
     */
    public function store(ReservationRequest $request)
    {
        // バリデーション済みデータをDBに保存
        $reservation = Reservation::create($request->validated());

        // 保存した予約情報をセッションに一時保存し、
        // 完了画面で表示できるようにする
        return redirect()
            ->route('reservation.complete')
            ->with('reservation', $reservation);
    }

    /**
     * 予約完了画面表示
     */
    public function complete()
    {
        // セッションに予約情報が存在しない場合は不正遷移とみなし、
        // 予約フォームへリダイレクトする
        if (!session()->has('reservation')) {
            return redirect()->route('reservation.create');
        }

        // セッションから予約情報を取得して完了画面へ渡す
        return view('reservation.complete', [
            'reservation' => session('reservation'),
        ]);
    }
}
