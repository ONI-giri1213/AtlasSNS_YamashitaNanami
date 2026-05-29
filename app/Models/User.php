<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'icon_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //followsリレーション
    //フォローしている側のテーブル
    public function follows(){
        return $this->belongsToMany(
        User::class,
        'follows',
        'following_id',
        'followed_id'
        );
    }

    //followsリレーション
    //フォローされてる側のテーブル
    public function followers(){
    return $this->belongsToMany(
        User::class,
        'follows',
        'followed_id',
        'following_id'
    );
    }

    //フォローしているかの判定
    public function following($id)
    {
        return $this->follows()         //フォロー一覧から自分のIDがfollowing_idに入っているもの
        ->where('followed_id', $id)     //中からfollowed_idに指定した相手のIDが
        ->exists();                     //存在しているかの判定
    }

    //postsリレーション
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }
}
