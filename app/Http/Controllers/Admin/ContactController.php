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
     * ステータス更新（未対応 ↔ 対応済）
     */
    public function updateStatus(Request $request, Contact $contact)
    {
        $contact->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'ステータスを更新しました。');
    }

    /**
     * 削除
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'お問い合わせを削除しました。');
    }
}

