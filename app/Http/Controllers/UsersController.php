<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;

class UsersController extends Controller
{
    //-------------------------------ログイン処理-------------------------------
    public function login(Request $request){
        //バリデーション
        $login = $request->validate([
            //入力必須、メールアドレス形式
            'email' => ['required', 'email'],
            //入力必須
            'password' => ['required']
        ]);

        //Authを使ったログイン処理
        if (Auth::attempt($login)) {
            //セッションにログイン時の情報を追加
            $request -> session() -> regenerate();
            dd(Auth::user()); // ←ここに置く
            //トップ画面に移動
            return redirect('top');
        }

        //ログインできなかった場合
        return back()->withErrors([
            //エラーメッセージ
            'email' => 'メールアドレスとパスワードが一致しません'
            //入力されたメールアドレスを再度入力欄に入れる
        ])->onlyInput('email');
    }

    //ログイン画面表示処理
    //URLからログイン画面に飛ぶ用
    public function showLoginForm()
    {
        return view('auth.login');
    }
    //-------------------------------------------------------------------------

    //---------------------------------検索処理---------------------------------
    public function search(Request $request){
        //$users = User::get();
        //return view('users.search',['users'=>$users]);

        //検索したワードを$keyword変数で取得
        $keyword = $request->input('keyword');

        //自分以外のユーザーレコードを取得
        $users = User::where('id', '!=', Auth::id());//(1)

        //キーワードに値があるとき、値を取得してあいまい検索
        //検索にヒットしたレコードを$usersに取得
        //検索結果を表示するときだけ新しく登録した順に並べ替え（降順）
        if(!empty($keyword)){
            $users->where('username', 'like', '%'.$keyword.'%')->latest();//(2)
        }

        //検索ワードがない場合は、自分以外のユーザーレコードをそのまま表示する
        //リダイレクトでsearchのURLを指定して、ユーザ一覧ページを画面表示する
        return view('users.search', ['users' => $users->get()]);//(3)

        /*
        (1)で大枠の条件文を作成
        (2)で追加の条件文を作成　※ない場合は飛ばされる
        (3)で(1)と(2)のSQLを実行し結果を取得
         */

        /*
        //$keywordが空ではない場合と、空の場合で条件分岐
        if(!empty($keyword)){
            //入力してボタンを押した場合
            //Usersテーブルのusernameカラムからあいまい検索し、検索にヒットしたレコードを取得
            $users = User::where('username','like', '%'.$keyword.'%')
            //自分以外のユーザーレコードを取得
            ->where('username','like', '%'.$keyword.'%')
            ->get();
        }else{
            //何も入力せずにボタンを押した場合
            //usersテーブルの、自分以外のすべてのレコードを取得
             $users = User::where('id', '!=', Auth::id())->get();
        }
        //リダイレクトでsearchのURLを指定して、ユーザ一覧ページを画面表示する
        return view('users.search',['users'=>$users]);
        */
    }
    //-------------------------------------------------------------------------

    //-------------------------------新規追加処理-------------------------------
    public function userCreate(Request $request){
        //バリデーション
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

        //ユーザー名とメールアドレスとパスワードを取得
        $userdata = $request->only([
            'username',
            'email',
            'password'
        ]);
        //パスワードをハッシュ化
        $userdata['password'] = Hash::make($userdata['password']);
        //取得した値でUserテーブルに新規作成
        User::create($userdata);
        //新規追加後の画面に移動する
        //セッションに追加したユーザー名を入れる
        return redirect('/added')
        ->with('username', $userdata['username']);
    }
    //-------------------------------------------------------------------------

    //------------------------------ログアウト処理------------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    //-------------------------------------------------------------------------
}
