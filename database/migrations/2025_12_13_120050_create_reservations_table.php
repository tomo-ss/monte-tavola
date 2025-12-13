<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // 予約ID

            $table->string('name', 100); // 氏名
            $table->string('name_kana', 100); // カナ
            $table->string('email', 255); // メールアドレス
            $table->string('phone', 20); // 電話番号

            $table->date('date'); // 来店日
            $table->time('time'); // 来店時間

            $table->unsignedTinyInteger('people_count'); // 人数（1〜10）

            $table->text('note')->nullable(); // 備考（任意）

            $table->string('status', 20)->default('未確認'); // ステータス

            $table->timestamps(); // created_at / updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
