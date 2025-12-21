<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * 一覧・検索
     */
    public function index(Request $request)
    {
        $query = News::query();

        // タイトル検索
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // キーワード検索（本文）
        if ($request->filled('keyword')) {
            $query->where('body', 'like', '%' . $request->keyword . '%');
        }

        // 公開日
        if ($request->filled('published_at')) {
            $query->whereDate('published_at', $request->published_at);
        }

        $newsList = $query
            ->orderBy('published_at', 'desc')
            ->get();

        return view('admin.news.index', compact('newsList'));
    }

    /**
     * 編集（データ取得）
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('news'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        // バリデーション
        $validated = $request->validate([
            'title'        => 'required|max:255',
            'body'         => 'nullable',
            'published_at' => 'required|date',
            'image'        => 'nullable|image',
        ]);

        // 画像差し替え対応（あれば）
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image_path'] = $imagePath;
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'お知らせを更新しました。');
    }

    /**
     * 削除処理
     */
    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'お知らせを削除しました。');
    }


    /**
     * 新規作成フォーム表示
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * 確認画面へ（POST）
     */
    public function confirm(Request $request)
    {
        // バリデーション（とりあえず必須だけ）
        $validated = $request->validate([
            'title'         => 'required|max:255',
            'body'          => 'nullable',
            'image'         => 'nullable|image',
            'published_at'  => 'required|date',
        ]);

        // 画像があれば一時保存（本保存は store）
        $tempImagePath = null;
        if ($request->hasFile('image')) {
            $tempImagePath = $request->file('image')->store('temp', 'public');
        }

        return view('admin.news.confirm', [
            'data' => $validated,
            'image_path' => $tempImagePath,
        ]);
    }

    /**
     * データ保存（完了画面へ）
     */
    public function store(Request $request)
    {
        // hiddenで受け取るデータ
        $data = $request->all();

        // 画像の本保存
        $imagePath = null;
        if (!empty($data['image_path'])) {
            // temp → news に移動
            $newPath = str_replace('temp/', 'news/', $data['image_path']);
            \Storage::disk('public')->move($data['image_path'], $newPath);
            $imagePath = $newPath;
        }

        // DB登録
        News::create([
            'title'         => $data['title'],
            'body'          => $data['body'] ?? null,
            'image_path'    => $imagePath,
            'published_at'  => $data['published_at'],
        ]);

        return redirect()->route('admin.news.complete');
    }

    /**
     * 完了画面
     */
    public function complete()
    {
        return view('admin.news.complete');
    }
}
