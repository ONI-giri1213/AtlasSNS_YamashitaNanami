<x-login-layout>

<div id="follow-wrapper">
  <h3>フォロワーリスト</h3>
  <!--フォロワーー一覧-->
  <div id="follower-list">
    @foreach ($followers as $follower)
      <div id="follower-box">
        <!--アイコンをクリックしたとき、それぞれのプロフィールに飛ぶ-->
        {{ Form::open(['url' => "/profile/{$follower->id}"]) }}
        <button type="submit" class="icon-btn">
          <img class="icon" src="images/{{ $follower->icon_image }}">
        </button>
        {{ Form::close() }}
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
        {{ Form::open(['url' => "/profile/{$post->user->id}"]) }}
          <button type="submit" class="icon-btn">
            <img class="icon" src="images/{{ $post->user->icon_image }}">
          </button>
        {{ Form::close() }}
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
