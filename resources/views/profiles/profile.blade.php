<x-login-layout>

@if (request('id'))
<!--自分以外のユーザープロフィール-->
<!--profile/が空白の時は非表示-->
<div  class="user-profile">
  <div id="profile-wrapper">
    <div id="profile-box">
      <img class="icon" src="/images/{{ $user->icon_image }}">
      <table>
        <tr>
          <th>ユーザー名</th>
         <td>{{ $user->username }}</td>
        </tr>
        <tr>
          <th>自己紹介</th>
          <td>{{ $user->bio }}</td>
        </tr>
      </table>
    </div>

    <div class="follow-btn-wrapper">
        <!--followingで自分が相手をフォローしているか判定-->
        @if (Auth::user()->following($user->id))
          <!--フォローしてるときに表示-->
          {{ Form::open(['url' => "/unfollow/{$user->id}",'method' => 'post']) }}
            <button type="submit" class="unfollow-btn">
              フォロー解除
            </button>
          {{ Form::close() }}
        @else
          <!--フォローしてないときに表示-->
          {{ Form::open(['url' => "/follow/{$user->id}", 'method' => 'post' ]) }}
            <button type="submit" class="follow-btn">
              フォローする
            </button>
          {{ Form::close() }}
        @endif
    </div>
  </div>

  <!--投稿一覧-->
  <div class="posts-list">
    @foreach ($posts as $post)
    <div class="list-box">
      <div class="posts-header">
        <div class="user-info">
          <!--ユーザーアイコン-->
          <img class="icon" src="/images/{{ $post->user->icon_image }}">
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
</div>

@else
<!--自分のユーザープロフィール-->
<!--profile/に値がある時は非表示-->
<div id="profile-update-wrapper">
  <img class="icon" src="{{ asset('images/' . $user->icon_image) }}">
  {{ Form::open(['url' => '/profile/update' ,'files' => true]) }}

  <!--ユーザー名-->
  <div class="update-box">
    {{ Form::label('ユーザー名','ユーザー名',['class' => 'update-label']) }}
    {{ Form::text('username',$user->username,['class' => 'update-form']) }}
  </div>
  <!--メールアドレス-->
  <div class="update-box">
    {{ Form::label('メールアドレス','メールアドレス',['class' => 'update-label']) }}
    {{ Form::email('email',$user->email,['class' => 'update-form']) }}
  </div>
  <!--パスワード-->
  <div class="update-box">
    {{ Form::label('パスワード','パスワード',['class' => 'update-label']) }}
    {{ Form::password('newpassword',['class' => 'update-form']) }}
  </div>
  <!--パスワード確認-->
  <div class="update-box">
    {{ Form::label('パスワード確認','パスワード確認',['class' => 'update-label']) }}
    {{ Form::password('newpassword_confirmation',['class' => 'update-form']) }}
  </div>
  <!--自己紹介-->
  <div class="update-box">
    {{ Form::label('自己紹介','自己紹介',['class' => 'update-label']) }}
    {{ Form::text('bio',$user->bio,['class' => 'update-form']) }}
  </div>
  <!--アイコン画像-->
  <div class="update-box update-img">
    {{ Form::label('アイコン画像','アイコン画像',['class' => 'update-label']) }}
    {{ Form::file('iconimage',['class' => 'update-form','id' => 'imgInput']) }}
  </div>

  <!--更新ボタン-->
  {{ Form::submit('更新',['class' => 'sub-btn']) }}

  {{ Form::close() }}

</div>

@endif

</x-login-layout>
