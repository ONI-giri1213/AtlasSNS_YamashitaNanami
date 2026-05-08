<x-login-layout>

<!--検索フォーム-->
{!! Form::open(['url' => 'search', 'method' => 'get']) !!}
<div id="search-wrapper">
  <!--検索テキストエリア-->
  <!--検索時にurl/search?keyword= から値を取得して入れる-->
  {{ Form::text('keyword', request('keyword'), ['class' => 'form-control search-name','placeholder' => 'ユーザー名']) }}
  <!--検索ボタン-->
  <button type="submit" class="search-btn">
    <img src="{{ asset('images/search.png') }}" alt="検索">
  </button>
</div>
{!! Form::close() !!}

<!--ユーザー一覧-->
<div class="user-list">
@foreach ($users as $user)
    <div class="user-box">
      <div class="user-info">
        <!--ユーザーアイコン-->
        <img class="icon" src="images/{{ $user->icon_image }}">
        <!--ユーザー名-->
        <p class="username">{{ $user->username }}</p>
      </div>
      <div class="follow-btn-wrapper">
        <!--フォローしてないときに表示-->
        @if ($user->followed_id != Auth::id())
        {{ Form::open(['url' => "/follow/{$user->id}"]) }}
          <button type="submit" class="follow-btn">
            フォローする
          </button>
        {{ Form::close() }}
        @endif
        <!--フォローしてるときに表示-->
        @if ($user->followed_id === Auth::id())
        {{ Form::open(['url' => "/unfollow/{$user->id}"]) }}
          <button type="submit" class="unfollow-btn">
            フォロー解除
          </button>
        {{ Form::close() }}
        @endif
      </div>
    </div>
@endforeach
</div>

</x-login-layout>
