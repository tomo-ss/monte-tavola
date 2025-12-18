<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReservationController extends Controller
{
    /**
     * 予約一覧表示（検索対応）
     */
    public function index(Request $request)
    {
        $query = Reservation::query();

        // ===============================
        // 検索条件
        // ===============================

        // 来店日
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        // 氏名（部分一致）
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // ステータス
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ===============================
        // 並び順
        // ===============================
        $reservations = $query
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('admin.reservation.index', compact('reservations'));
    }

    /**
     * CSV出力（検索条件を反映）
     */
    public function exportCsv(Request $request)
    {
        $query = Reservation::query();

        // 検索条件（indexと同じ）
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

            // ヘッダー行
            fputcsv($handle, [
                'ID',
                '氏名',
                'カナ',
                '来店日',
                '来店時間',
                '人数',
                'ステータス',
            ]);

            // データ行
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
        });

        return $response->withHeaders([
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="reservations.csv"',
        ]);
    }

    /**
     * ステータス切り替え（未確認 ⇔ 確認済）
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
