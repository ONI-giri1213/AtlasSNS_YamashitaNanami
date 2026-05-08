<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //---------------------------投稿内容を一覧表示----------------------------
    public function index(){
        //Postモデル（postsテーブル）からレコード情報を最新順に取得
        $posts = Post::latest()->get();
        return view('posts.index',['posts'=>$posts]);
    }
    //-------------------------------------------------------------------------

    //--------------------------------投稿処理--------------------------------
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

    //---------------------------------編集処理---------------------------------
    public function update(Request $request, $id)
    {
        //バリデーション
        $request->validate([
            //入力必須、1文字以上150文字以内
            'post' => 'required|min:1|max:150',
        ]);

        //選択したpost_idと一致するpostsデータを探す
        $post = Post::where('id',$id);
        //該当のポストデータを更新
        $post->update([
            //フォーム(編集用モーダル)入力内容で更新する
            'post' => $request->input('post')
        ]);

        //編集後、トップにリダイレクト
        return redirect('/top');
    }
    //-------------------------------------------------------------------------

    //---------------------------------削除処理---------------------------------
    public function delete($id)
    {
        //選択したpost_idと一致するpostsデータベース上のpost_idを取得、削除
        Post::where('id', $id)->delete();
        //削除後、トップにリダイレクト
        return redirect('/top');
    }
    //-------------------------------------------------------------------------
}
