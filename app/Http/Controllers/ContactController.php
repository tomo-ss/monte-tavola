<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * 入力画面
     */
    public function form()
    {
        return view('contact.form');
    }

    /**
     * 確認画面
     */
    public function confirm(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:2000',
        ]);

        return view('contact.confirm', ['inputs' => $validated]);
    }

    /**
     * 完了画面 & DB保存
     */
    public function complete(Request $request)
    {
        // 戻るボタン
        if ($request->input('action') === 'back') {
            return redirect()->route('contact.form')
                             ->withInput($request->except('action'));
        }

        // DB保存
        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status'  => '未対応', // 初期値
        ]);

        return view('contact.complete');
    }
}
