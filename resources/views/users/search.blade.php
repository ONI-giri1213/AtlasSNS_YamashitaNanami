<x-login-layout>

<!--検索フォーム-->
{!! Form::open(['url' => 'post', 'method' => 'post']) !!}
<div id="search-wrapper">
  <!--検索テキストエリア-->
  {{ Form::text('search', null, ['class' => 'form-control search-name','placeholder' => 'ユーザー名']) }}
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
        <p class="search-username">{{ $user->username }}</p>
      </div>
    </div>
@endforeach
</div>

</x-login-layout>
