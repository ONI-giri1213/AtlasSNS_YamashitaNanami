<x-logout-layout>

  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => 'login', 'method' => 'post']) !!}

<div class="container">
  <div class="box">
    <div class="login-box">
        <p class="sub-tittle">AtlasSNSへようこそ</p>

        <div class="input-box">
        {{ Form::label('email','メールアドレス',['class' => 'form-label'])}}
        {{ Form::text('email',null,['class' => 'input form-control rounded-pill']) }}
        </div>
        <div class="input-box">
        {{ Form::label('password','パスワード',['class' => 'form-label']) }}
        {{ Form::password('password',['class' => 'input form-control rounded-pill']) }}
        </div>

        {{ Form::submit('ログイン',['class' => 'sub-btn']) }}
      <p class="a-box"><a class="a-text" href="/register">新規ユーザーの方はこちら</a></p>
    </div>
  </div>
</div>

  {!! Form::close() !!}

</x-logout-layout>
