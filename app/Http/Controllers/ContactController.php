<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
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
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->validated();

        return view('contact.confirm', compact('inputs'));
    }

    /**
     * 完了画面 & DB保存
     */
    public function complete(ContactRequest $request)
    {
        // 戻るボタン
        if ($request->input('action') === 'back') {
            return redirect()
                ->route('contact.form')
                ->withInput($request->except('action'));
        }

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status'  => '未対応',
        ]);

        return view('contact.complete');
    }
}
