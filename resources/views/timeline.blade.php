@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        {!! Form::open(['route' => 'timeline', 'method' => 'POST']) !!}
            {{ csrf_field() }}
            <div class="row mb-4">
                @guest
                    <div class="mx-auto">
                        <a class="btn btn-primary" href="{{ route('login') }}">ログインしてツイートする</a>
                        <a class="btn btn-primary" href="{{ route('register') }}">新規登録してツイートする</a>
                    </div>
                @else
                <div class="col-sm-4">
                    @if (isset($user->image_url))
                        <img src={{ $user->image_url }}>
                    @else
                        <img src="https://thumb.ac-illust.com/e2/e2cb85acf732de018702298367234d84_t.jpeg" width=25% height=auto>
                    @endif
                    <strong>{{ $user->name }}</strong>
                    <br><br>
                    {{ Form::text('tweet', null, ['class' => 'form-control mr-auto']) }}
                    {{ Form::file('image_url', ['class'=>'custom-file-input','id'=>'image_url']) }}
                    {{ Form::submit('ツイート', ['class' => 'btn btn-primary']) }}
                </div>
                @endguest
                <div class="col-sm-8">
                    <table class="table table-bordered">
                @foreach ($tweets as $tweet)
                        <tr>
                            <td>
                                <strong>{{ $tweet->created_user }}</strong> {{ $tweet->created_at }}
                                <div>{{ $tweet->tweet }}</div>
                            </td>
                        <tr>
                @endforeach
                    </table>
                </div>
            </div>
            @if ($errors->has('tweet'))
                <p class="alert alert-danger">{{ $errors->first('tweet') }}</p>
            @endif
        {!! Form::close() !!}


    </div>
@endsection