<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>
  <!-- Page Content -->
  <div id="row">
    <div id="container">
      {{ $slot }}
    </div>
    <div id="side-bar">
      <div id="confirm">
        <p id='name'>{{ Auth::user()->username }}さんの</p>
        <div class="follow-wrapper">
          <p>フォロー数</p>
          <!--Models\User.phpで結合させたfollowテーブルから
          followingの数を取得-->
          <p class="number-people">{{ Auth::user()->follows->count() }}人</p>
        </div>
        <p class="btn side-btn"><a href="follow-list">フォローリスト</a></p>
        <div class="follow-wrapper">
          <!--Models\User.phpで結合させたfollowテーブルから
          followedの数を取得-->
          <p>フォロワー数</p>
          <p class="number-people">{{ Auth::user()->followers->count() }}人</p>
        </div>
        <p class="btn side-btn"><a href="follower-list">フォロワーリスト</a></p>
      </div>
      <p class="btn side-btn search"><a href="search">ユーザー検索</a></p>
    </div>
  </div>
  <footer>
  </footer>
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
