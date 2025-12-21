<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     * 保存処理
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|unique:holidays,date',
            'type' => 'required|string|max:20',
            'note' => 'nullable|string',
        ]);

        Holiday::create($validated);

        return redirect()
            ->route('admin.holiday.index')
            ->with('success', '休業日を登録しました。');
    }
}
