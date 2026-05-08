<x-login-layout>
@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif

<!--<h2>機能を実装していきましょう。</h2>-->
<!--投稿フォーム-->
{!! Form::open(['url' => 'post', 'method' => 'post']) !!}
<div id="post-wrapper">
  <div id="post-box">
    <img class="icon" src="images/{{ Auth::user()->icon_image }}">
      <!--ユーザーID-->
      {{ Form::hidden('user_id', Auth::id()) }}
      <!--投稿内容-->
      {{ Form::textarea('post', null, ['class' => 'form-control post-text','placeholder' => '投稿内容を入力してください']) }}
  </div>
  <!--{{ Form::submit('投稿') }}-->
  <button class="post-btn" type="submit">
    <img src="{{ asset('images/post.png') }}" alt="投稿">
  </button>
</div>
{!! Form::close() !!}

<!--投稿一覧-->
<div class="post-list">
@foreach ($posts as $post)
  <div class="list-box">

    <div class="post-header">
      <div class="user-info">
        <!--ユーザーアイコン-->
        <img class="icon" src="images/{{ $post->user->icon_image }}">
        <!--ユーザー名-->
        <p class="post-username">{{ $post->user->username }}</p>
      </div>

      <!--投稿日付　フォーマットで分数までの表示、秒数は切り捨て-->
      <p class="post-date">
        {{ $post->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <!--投稿内容-->
    <p class="post-content">
      <!--{{ $post->post }}-->
      <!--改行ある投稿を改行で表示-->
      {!! nl2br(e($post->post)) !!}
    </p>


    <div class="btn-wrapper">
    <!--自分ポストにだけボタンを表示-->
    @if ($post->user_id === Auth::id())
      <!--編集ボタン-->
      <div class="edit">
        <!--モーダルを開く用のボタン-->
        <button type="button" class="edit-btn modal-open"
        data-target="edit-modal-{{$post->id}}">
          <img src="{{ asset('images/edit.png') }}" alt="編集">
        </button>
      </div>

      <!--削除ボタン-->
      <div class="trash">
        <button type="button" class="trash-btn modal-open"
        data-target="trash-modal-{{$post->id}}">
          <img src="{{ asset('images/trash.png') }}" alt="削除">
        </button>
      </div>
    @endif
    </div>

  </div>

  <!--編集モーダル-->
  <!--非表示-->
  <div class="edit-modal" id="edit-modal-{{$post->id}}">
    <div class="edit-modal-content">
      <!--編集エリア-->
      {{ Form::open(['url' => "/post/{$post->id}/update"]) }}
        <!--postサーバーから投稿内容を取得し表示-->
        {{ Form::textarea('post', $post->post, [
          'class' => 'modal-textarea'
        ]) }}
        <div class="edit-modal-btn">
          <button type="submit" class="update-btn">
            <img src="{{ asset('images/edit.png') }}" alt="編集">
          </button>
        </div>
      {{ Form::close() }}
    </div>
  </div>

  <!--削除モーダル-->
  <!--非表示-->
  <div class="trash-modal" id="trash-modal-{{$post->id}}">
    <div class="trash-modal-content">
      <!--編集エリア-->
      {{ Form::open(['url' => "/post/{$post->id}/delete"]) }}
        <p>この投稿を削除します。よろしいでしょうか？</p>
        <div class="trash-modal-btn">
          <button type="submit" class="ok-btn">OK
          </button>
          <button type="button" class="cancel cancel-btn">キャンセル
          </button>
        </div>
      {{ Form::close() }}
    </div>
  </div>

@endforeach
</div>


<script>

//編集・削除ボタンを押したときの処理
document.querySelectorAll('.modal-open').forEach(button => {
    button.addEventListener('click', () => {
        //edit-modalもしくはtrash-modal{{$post->id}}のモーダルを取得
        const target = button.dataset.target;
        //非表示にしていたモーダルを表示させる。
        document.getElementById(target).style.display = 'block';
    });
});
//モーダルの外をクリックしたときの処理
window.addEventListener('click', e => {
    //クリックした要素がモーダル(.edit-modal)のクラスを持っているか判定
    //モーダルのボックス(.edit-modal-content)とは別
    //.edit-modal＞.edit-modal-content
    if(e.target.classList.contains('edit-modal')){
        //モーダルを非表示に変更
        e.target.style.display = 'none';
    }
});

//削除モーダル、キャンセルクリックしたときの処理
document.querySelectorAll('.cancel').forEach(button => {
    button.addEventListener('click', () => {
        //モーダルを非表示に変更
        button.closest('.trash-modal').style.display = 'none';
    });
});

</script>

</x-login-layout>
