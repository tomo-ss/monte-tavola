<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class TopController extends Controller
{
    public function index()
    {
        // 最新3件だけ取得
        $latest_news = News::orderBy('published_at', 'desc')
                            ->take(3)
                            ->get();

        return view('top', compact('latest_news'));
    }
}
