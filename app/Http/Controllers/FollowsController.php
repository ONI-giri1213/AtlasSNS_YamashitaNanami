<?php

namespace App\Http\Controllers;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //------------------------------フォロー一覧--------------------------------
    public function followList(){
        //ログインしているユーザー情報を取得
        $user = Auth::user();
        //ログインしているユーザーがフォローしてるユーザーをフォロー一覧表から取得
        $follows = $user->follows;
        //フォローしているユーザーの投稿だけを取得
        $posts = Post::whereIn('user_id', $follows->pluck('id'))->latest()->get();
        //フォローしているユーザー情報と投稿を返す
        return view('follows.followList',['follows'=>$follows,'posts'=>$posts]);
    }
    //-------------------------------------------------------------------------

    //------------------------------フォロワー一覧------------------------------
    public function followerList(){
        //ログインしているユーザー情報を取得
        $user = Auth::user();
        //ログインしているユーザーフォロワー一覧表から取得
        $followers = $user->followers;
        //フォロワーの投稿だけを取得
        $posts = Post::whereIn('user_id', $followers->pluck('id'))->latest()->get();
        //フォロワーのユーザー情報と投稿を返す
        return view('follows.followerList',['followers'=>$followers,'posts'=>$posts]);
    }
    //-------------------------------------------------------------------------

    //------------------------------フォロー処理------------------------------
    public function follow($id){
        //自分のidをfollowsテーブルのfollowing_idに入れる（フォローした人）
        //相手のユーザーidをfollowsテーブルのfollowed_idに入れる（フォローされた人）
        Follow::create([
            'following_id' => Auth::id(),
            'followed_id' => $id,
        ]);

        //フォロー処理後、前の画面にリダイレクト
        return redirect()->back();
    }
    //-------------------------------------------------------------------------

    //-----------------------------フォロー解除処理-----------------------------
    public function unfollow($id){
        //follow::where('id', $id)->delete();

        //自分がフォローしているリストを探す
        Follow::where('following_id', Auth::id())
        //その中からフォローされているIDと選択したIDが一致するデータを選択
        ->where('followed_id', $id)
        //削除
        ->delete();

        //フォロー解除処理後、前の画面にリダイレクト
        return redirect()->back();
    }
    //-------------------------------------------------------------------------
}
