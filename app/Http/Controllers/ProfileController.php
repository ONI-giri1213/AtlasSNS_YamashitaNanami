<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
    //---------------------------プロフィール表示処理----------------------------
    //$idが空白、プロフィール選択時はnullを入れる
    public function profile($id = null){
        //id空白、ログインユーザーの時
        if ($id === null) {
            //ログインユーザーの情報をuserテーブルから取得
            $user = Auth::user();
            //ログインユーザーのidを$idに格納
            $id = $user->id;
        } else {
            //idを取得し、Userテーブルから情報を取得
            $user = User::find($id);
        }
        //idと一致するuser_idのポストのみ取得、降順
        $posts = Post::where('user_id', $id )->latest()->get();
        //ユーザー情報と投稿を返す
        return view('profiles.profile',['user'=>$user,'posts'=>$posts]);
    }
    //-------------------------------------------------------------------------
}
