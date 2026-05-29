<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        }
        //idがある、他ユーザーの時
        else {
            //idを取得し、Userテーブルから情報を取得
            $user = User::find($id);
        }
        //idと一致するuser_idのポストのみ取得、降順（他ユーザー時だけ取得される）
        $posts = Post::where('user_id', $id )->latest()->get();
        //ユーザー情報と投稿を返す
        return view('profiles.profile',['user'=>$user,'posts'=>$posts]);
    }
    //-------------------------------------------------------------------------

    //---------------------------プロフィール編集処理----------------------------
    public function profileUpdate(Request $request){
        //バリデーション
        $request->validate([
            //入力必須、2文字以上12文字以内
            'username' => 'required|min:2|max:12',
            //メールアドレスの形式、5文字以上40文字以内
            'email' => 'required|email|email|min:5|max:40',
            //英数字のみ、8文字以上20文字以内
            'newpassword' => 'required|alpha_num|min:8|max:20|confirmed',
            //入力必須、英数字のみ、8文字以上20文字以内、passwordと一致しているか
            'newpassword_confirmation' => 'required|alpha_num|min:8|max:20',
            //150文字以内
            'bio' => 'max:150',
            //未選択可、画像のみ
            'iconimage' => ['nullable', 'image'],
        ]);

        //ログインユーザー情報を取得
        $profile = Auth::user();

        //更新データの取得
        $updateData = $request->only ([
            'username',
            'email',
            'bio' ,
        ]);

        //パスワードをハッシュ化して取得
        $updateData['password'] = Hash::make($request->newpassword);

        //アイコン画像の処理
        if($request->hasFile('iconimage')){
            //$fileにアップロードした画像を格納
            $file = $request->file('iconimage');
            //ファイル名を画像名で作成
            $fileName = $file->getClientOriginalName();
             //public/imagesにファイル名と画像ファイルを保存
            $file->move(public_path('images'), $fileName);
            //更新用データにアイコン（ファイル名）を入れる
            $updateData['icon_image'] = $fileName;
        }

        //ログインユーザーの情報を、取得したデータに書き換える
        $profile->update($updateData);

        //プロフィール編集画面に戻る
        return redirect('/profile');
    }
    //-------------------------------------------------------------------------

}
