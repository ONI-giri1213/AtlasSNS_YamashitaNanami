<x-logout-layout>
<div class="container">
  <div class="box">
      <div class="add-box" id="clear">
        <p class="add-text"><b>{{ session('username') }}さん</b></p>
        <p class="add-text">ようこそ！<b>AtlasSNSへ</b></p>
        <p class="add-text">ユーザー登録が完了しました。</p>
        <p class="add-text">早速ログインをしてみましょう。</p>

        <p class="btn sub-btn"><a class="add-text" href="login">ログイン画面へ</a></p>
    </div>
  </div>
</div>
</x-logout-layout>
