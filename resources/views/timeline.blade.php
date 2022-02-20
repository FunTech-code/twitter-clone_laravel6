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
                    {{ Form::text('tweet', null, ['class' => 'form-control col-9 mr-auto']) }}
                    {{ Form::file('image_url', ['class'=>'custom-file-input','id'=>'image_url']) }}
                    {{ Form::submit('ツイート', ['class' => 'btn btn-primary col-2']) }}
                @endguest
            </div>
            @if ($errors->has('tweet'))
                <p class="alert alert-danger">{{ $errors->first('tweet') }}</p>
            @endif
        {!! Form::close() !!}

        @foreach ($tweets as $tweet)
            <div class="mb-1">
                <strong>{{ $tweet->name }}</strong> {{ $tweet->created_at }}
            </div>
            <div class="pl-3">
                {{ $tweet->tweet }}
            </div>
            <hr>
        @endforeach
    </div>
@endsection