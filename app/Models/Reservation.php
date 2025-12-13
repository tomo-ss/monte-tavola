<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // 使用するテーブル名
    protected $table = 'reservations';

    // 一括代入を許可するカラム
    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'phone',
        'date',
        'time',
        'people_count',
        'note',
        'status',
    ];
}
