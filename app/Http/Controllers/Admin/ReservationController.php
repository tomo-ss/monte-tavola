<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * 予約一覧表示
     */
    public function index()
    {
        $reservations = Reservation::orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('admin.reservation.index', compact('reservations'));
    }

    /**
     * ステータスを「確認済」に変更
     */
    public function toggleStatus($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->status =
            $reservation->status === '確認済' ? '未確認' : '確認済';

        $reservation->save();

        return redirect()
            ->route('admin.reservation.index');
    }

}
