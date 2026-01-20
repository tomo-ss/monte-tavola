<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Models\Holiday;

class HolidayController extends Controller
{
    /**
     * 休業日一覧
     */
    public function index()
    {
        $holidays = Holiday::orderBy('date', 'desc')->get();
        return view('admin.holiday.index', compact('holidays'));
    }

    /**
     * 新規登録画面
     */
    public function create()
    {
        return view('admin.holiday.create');
    }

    /**
     * 新規登録（即時登録）
     */
    public function store(StoreHolidayRequest $request)
    {
        Holiday::create($request->validated());

        return redirect()
            ->route('admin.holiday.index')
            ->with('success', '休業日を登録しました。');
    }

    /**
     * 更新処理
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        $holiday->update($request->validated());

        return redirect()
            ->route('admin.holiday.index')
            ->with('success', '休業日を更新しました。');
    }

    /**
     * 削除処理
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()
            ->route('admin.holiday.index')
            ->with('success', '休業日を削除しました。');
    }
}