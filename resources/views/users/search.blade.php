<x-login-layout>

<!--検索フォーム-->
{!! Form::open(['url' => 'search', 'method' => 'get']) !!}
<div id="search-wrapper">
  <!--検索テキストエリア-->
  {{ Form::text('keyword', null , ['class' => 'form-control search-name','placeholder' => 'ユーザー名']) }}
  <!--検索ボタン-->
  <button type="submit" class="search-btn">
    <img src="{{ asset('images/search.png') }}" alt="検索">
  </button>
  <!--検索ワードが空白の時は非表示-->
  @if (request('keyword'))
    <!--検索時にurl/search?keyword= から値を取得して入れる-->
    <!--検索ワード：'keyword'-->
    <p>検索ワード：{{request('keyword')}}</p>
  @endif
</div>
{!! Form::close() !!}

<!--ユーザー一覧-->
<div class="user-list">
@foreach ($users as $user)
    <div class="user-box">
      <div class="user-list-info">
        <!--ユーザーアイコン-->
        <img class="icon" src="images/{{ $user->icon_image }}">
        <!--ユーザー名-->
        <p class="username">{{ $user->username }}</p>
      </div>

      <div class="follow-btn-wrapper">
        <!--followingで自分が相手をフォローしているか判定-->
        @if (Auth::user()->following($user->id))
          <!--フォローしてるときに表示-->
          {{ Form::open(['url' => "/unfollow/{$user->id}"]) }}
            <button type="submit" class="btn btn-danger sub-btn">
              フォロー解除
            </button>
          {{ Form::close() }}
        @else
          <!--フォローしてないときに表示-->
          {{ Form::open(['url' => "/follow/{$user->id}"]) }}
            <button type="submit" class="btn btn-info sub-btn">
              フォローする
            </button>
          {{ Form::close() }}
        @endif
      </div>

    </div>
@endforeach
</div>

</x-login-layout>
