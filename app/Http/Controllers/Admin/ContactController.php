<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * お問い合わせ一覧
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * お問い合わせ詳細
     */
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * ステータス更新（未対応 ↔ 対応済）
     */
    public function updateStatus(Request $request, Contact $contact)
    {
        $contact->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.contacts.show', $contact)
            ->with('success', 'ステータスを更新しました。');
    }
}
