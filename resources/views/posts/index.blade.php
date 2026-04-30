<x-login-layout>
<!--<h2>機能を実装していきましょう。</h2>-->
<!--投稿フォーム-->
  <div id="post-wrapper">
    <div id="post-box">
      <img class="icon" src="images/{{ Auth::user()->icon_image }}">
        {{ Form::textarea('post', null, ['class' => 'form-control post-text','placeholder' => '投稿内容を入力してください',]) }}
    </div>
    <!--{{ Form::submit('投稿') }}-->
    <button class="post-btn" type="submit">
      <img src="{{ asset('images/post.png') }}" alt="投稿">
    </button>
  </div>
</x-login-layout>
