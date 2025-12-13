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
        return view('reservation.reservations');
    }

    /**
     * 予約フォーム送信 → 保存
     */
    public function store(ReservationRequest $request)
    {
        Reservation::create($request->validated());

        return redirect()
            ->back()
            ->with('success', '予約を受け付けました。');
    }
}
