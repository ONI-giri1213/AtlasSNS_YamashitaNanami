<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    //投稿内容を新規に追加
    protected $fillable = [
    'user_id',
    'post',
    ];

    protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    ];

    //フォローのテーブル処理
    public function user(){
       return $this->belongsTo('App\Models\User');
    }

}
