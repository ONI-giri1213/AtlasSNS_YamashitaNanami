<x-login-layout>

<div id="follow-wrapper">
  <h3>フォローリスト</h3>
  <!--フォロー一覧-->
  <div id="follow-list">
    @foreach ($follows as $follow)
      <div id="follow-box">
        <!--アイコンをクリックしたとき、それぞれのプロフィールに飛ぶ-->
        <a href="/profile/{{ $follow->id }}">
          <img class="icon" src="images/{{ $follow->icon_image }}">
        </a>
      </div>
    @endforeach
  </div>
</div>

<!--投稿一覧-->
<div class="posts-list">
@foreach ($posts as $post)
  <div class="list-box">
    <div class="posts-header">
      <div class="user-info">
        <!--ユーザーアイコン-->
        <a href="/profile/{{ $post->user->id }}">
          <img class="icon" src="/images/{{ $post->user->icon_image }}">
        </a>
        <div class="posts-wrapper">
        <!--ユーザー名-->
        <p class="posts-username">{{ $post->user->username }}</p>
          <!--投稿内容-->
          <p class="posts-content">
            <!--{{ $post->post }}-->
            <!--改行ある投稿を改行で表示-->
            {!! nl2br(e($post->post)) !!}
          </p>
        </div>
      </div>
      <!--投稿日付　フォーマットで分数までの表示、秒数は切り捨て-->
      <p class="posts-date">
        {{ $post->created_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
@endforeach
</div>

</x-login-layout>
