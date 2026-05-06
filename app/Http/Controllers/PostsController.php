<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }

    //-------------------------------投稿処理-------------------------------
    public function postCreate(Request $request){
        //バリデーション
        $request->validate([
            //入力必須、1文字以上150文字以内
            'post' => 'required|min:1|max:150',
        ]);

        //ユーザーIDと投稿内容を取得
        // DBに保存
        Post::create([
            'user_id' => Auth::id(),
            'post' => $request->input('post'),
        ]);

        //投稿後、トップにリダイレクト
        return redirect('/top');
    }
    //-------------------------------------------------------------------------
}
