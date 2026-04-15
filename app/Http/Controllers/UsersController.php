<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function search(){
        return view('users.search');
    }

    public function userCreate(Request $request){
        $request->validate([
            //入力必須、2文字以上12文字以内
            'username' => 'required|min:2|max:12',
            //入力必須、メールアドレスの形式、登録済みのメールアドレス使用不可、5文字以上40文字以内
            'email' => 'required|email|unique:users,email|min:5|max:40',
            //入力必須、英数字のみ、8文字以上20文字以内
            'password' => 'required|alpha_num|min:8|max:20|confirmed',
            //入力必須、英数字のみ、8文字以上20文字以内、passwordと一致しているか
            'password_confirmation' => 'required|alpha_num|min:8|max:20',
        ]);
        $userdata = $request->only([
            'username',
            'email',
            'password'
        ]);
        User::create($userdata);
        return redirect('/added')
        //セッションに追加したユーザー名を入れる
        ->with('username', $userdata['username']);
    }
}
