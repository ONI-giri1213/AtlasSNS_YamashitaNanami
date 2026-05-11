<x-login-layout>
{!! Form::open(['url' => 'post', 'method' => 'post']) !!}
<div id="profile-wrapper">
  <div id="profile-box">
    <img class="icon" src="images/{{ Auth::user()->icon_image }}">
  </div>
  <div class="follow-btn-wrapper">
        <!--followingで自分が相手をフォローしているか判定-->
        @if (Auth::user()->following($user->id))
          <!--フォローしてるときに表示-->
          {{ Form::open(['url' => "/unfollow/{$user->id}"]) }}
            <button type="submit" class="unfollow-btn">
              フォロー解除
            </button>
          {{ Form::close() }}
        @else
          <!--フォローしてないときに表示-->
          {{ Form::open(['url' => "/follow/{$user->id}"]) }}
            <button type="submit" class="follow-btn">
              フォローする
            </button>
          {{ Form::close() }}
        @endif
    </div>
</div>
{!! Form::close() !!}

</x-login-layout>
