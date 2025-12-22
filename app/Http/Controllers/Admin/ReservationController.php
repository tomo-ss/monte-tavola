<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * 予約一覧表示（検索対応）
     */
    public function index(Request $request)
    {
        $query = Reservation::query();

        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('admin.reservation.index', compact('reservations'));
    }

    /**
     * CSV出力
     */
    public function exportCsv(Request $request)
    {
        $query = Reservation::query();

        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return response()->streamDownload(function () use ($reservations) {
            $handle = fopen('php://output', 'w');

            // ★ Excel文字化け対策（UTF-8 BOM）
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'ID',
                '氏名',
                'カナ',
                '来店日',
                '来店時間',
                '人数',
                'ステータス',
            ]);

            foreach ($reservations as $reservation) {
                fputcsv($handle, [
                    $reservation->id,
                    $reservation->name,
                    $reservation->name_kana,
                    $reservation->date,
                    $reservation->time,
                    $reservation->people_count,
                    $reservation->status,
                ]);
            }

            fclose($handle);
        }, 'reservations.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * ステータス更新（未確認 ↔ 確認済）
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => ['required', 'in:未確認,確認済'],
        ]);

        $reservation->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.reservation.index')
            ->with('success', 'ステータスを更新しました。');
    }

    /**
     * 予約削除
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()
            ->route('admin.reservation.index')
            ->with('success', '予約を削除しました。');
    }
}
