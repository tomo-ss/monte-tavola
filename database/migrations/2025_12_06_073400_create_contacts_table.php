<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();                                   // 問い合わせID
            $table->string('name', 255);                    // 氏名
            $table->string('email', 255);                   // メールアドレス
            $table->string('subject', 255);                 // 件名
            $table->text('message');                        // 本文
            $table->string('status', 50)->default('未対応'); // 対応状況（初期値：未対応）
            $table->timestamps();                           // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
