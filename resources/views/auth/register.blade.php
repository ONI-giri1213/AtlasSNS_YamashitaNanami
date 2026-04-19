<x-logout-layout>
    <!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/user/create','method' => 'post']) !!}

<div class="container">
    <div class="box">
        <div class="useradd-box">
            <h2 class="sub-tittle">新規ユーザー登録</h2>

            <div class="input-box">
            {{ Form::label('ユーザー名','ユーザー名',['class' => 'form-label']) }}
            {{ Form::text('username',null,['class' => 'input form-control rounded-pill']) }}
            </div>
            <div class="input-box">
            {{ Form::label('メールアドレス','メールアドレス',['class' => 'form-label']) }}
            {{ Form::email('email',null,['class' => 'input form-control rounded-pill']) }}
            </div>
            <div class="input-box">
            {{ Form::label('パスワード','パスワード',['class' => 'form-label']) }}
            {{ Form::password('password',['class' => 'input form-control rounded-pill']) }}
            </div>
            <div class="input-box">
            {{ Form::label('パスワード確認','パスワード確認',['class' => 'form-label']) }}
            {{ Form::password('password_confirmation',['class' => 'input form-control rounded-pill']) }}
            </div>

            <!--ユーザー登録デバック用
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            -->

            {{ Form::submit('新規登録',['class' => 'sub-btn']) }}

            <p class="a-box"><a class="a-text" href="login">ログイン画面へ戻る</a></p>
        </div>
    </div>
</div>
{!! Form::close() !!}


</x-logout-layout>
