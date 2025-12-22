<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Holiday;

class ReservationController extends Controller
{
    /**
     * 予約フォーム表示
     */
    public function create()
    {
        // 予約済み（キャンセル以外）の日時を取得
        $reservedTimes = Reservation::where('status', '!=', 'キャンセル')
            ->get()
            ->groupBy('date')
            ->map(function ($items) {
                return $items->pluck('time')->map(function ($time) {
                    return \Carbon\Carbon::parse($time)->format('H:i');
                });
            });
        
        // 休業日（dateだけ取得）
        $holidays = Holiday::pluck('date')->toArray();


        return view('reservation.reservation', compact('reservedTimes'));
    }

    /**
     * 予約内容 確認画面表示
     */
    public function confirm(ReservationRequest $request)
    {
        $data = $request->validated();
        return view('reservation.confirm', compact('data'));
    }

    /**
     * 予約内容 保存処理
     */
    public function store(ReservationRequest $request)
    {
        $reservation = Reservation::create($request->validated());

        return redirect()
            ->route('reservation.complete')
            ->with('reservation', $reservation);
    }

    /**
     * 予約完了画面表示
     */
    public function complete()
    {
        if (!session()->has('reservation')) {
            return redirect()->route('reservation.create');
        }

        return view('reservation.complete', [
            'reservation' => session('reservation'),
        ]);
    }

    



}
