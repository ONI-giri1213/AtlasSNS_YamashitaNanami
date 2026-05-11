<x-login-layout>
<div id="profile-wrapper">
  <div id="profile-box">
    <img class="icon" src="/images/{{ $user->icon_image }}">
    <tr>
      <th>ユーザー名</th>
      <th>自己紹介</th>
    </tr>
    <tr>
      <td>{{ $user->username }}</td>
      <td>{{ $user->bio }}</td>
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
</x-login-layout>
