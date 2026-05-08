<?php

namespace App\Http\Controllers;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){
        $follows = Follow::get();
        return view('follows.followList');
    }
    public function followerList(){
        $followers = Follow::get();
        return view('follows.followerList');
    }

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
