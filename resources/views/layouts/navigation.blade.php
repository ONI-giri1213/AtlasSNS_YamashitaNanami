<div id="head">
    <h1><a href = "/top"><img id="top-logo" src="images/atlas.png"></a></h1>
    <div id="top">
        <div id="username">
          <p>{{ session('username') }} さん</p>
        </div>
        <div class="menu-trigger">
          <span></span>
        </div>
        <nav class="menu-navi">
            <ul>
                <li><a href="">HOME</a></li>
                <li><a href="">プロフィール編集</a></li>
                <li><a href="">ログアウト</a></li>
            </ul>
        </nav>
    </div>
</div>
<script>
//ハンバーガーメニューを開く
document.querySelector('.menu-trigger').addEventListener('click', function() {
    this.classList.toggle('active');
    document.querySelector('.menu-navi').classList.toggle('active');
});
//メニューの外をクリックしたら閉じる
document.addEventListener('click', function(e) {
    if (!e.target.closest('.menu-trigger') && !e.target.closest('.menu-navi')) {
        document.querySelector('.menu-trigger').classList.remove('active');
        document.querySelector('.menu-navi').classList.remove('active');
    }
});
</script>
