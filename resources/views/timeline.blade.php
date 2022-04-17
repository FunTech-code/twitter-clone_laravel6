@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        @if (count($errors))
            @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
        @endif
        {!! Form::open(['route' => 'timeline', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{ csrf_field() }}
            <div class="row mb-4">
                @guest
                <div class="col-sm-12">
                    <table class="table table-bordered">
                @else
                <div class="col-sm-4">
                @if (isset($user->image_url))
                    <img src={{ asset('storage/'.$user->image_url)}} width=100% height=auto><br>
                @else
                    <img src="https://thumb.ac-illust.com/e2/e2cb85acf732de018702298367234d84_t.jpeg" width=100% height=auto><br>
                @endif
                    <strong>{{ $user->name }}</strong>
                    <br><br>
                    {{ Form::text('tweet', null, ['class' => 'form-control mr-auto']) }}
                    {{ Form::file('image_url', ['id'=>'image_url','class' => 'form-control mr-auto']) }}
                    {{ Form::submit('ツイート', ['class' => 'btn btn-primary']) }}
                </div>
                <div class="col-sm-8">
                    <table class="table table-bordered">
                @endguest
                @foreach ($tweets as $tweet)
                        <tr>
                            <td>
                                <strong>{{ $tweet->created_user }}</strong> {{ $tweet->created_at }}
                                <div>{{ $tweet->tweet }}</div>
                                @if (isset($tweet->image_url))
                                    <img src={{ asset('storage/'.$tweet->image_url)}} width=100% height=auto><br>
                                @endif
                            </td>
                        <tr>
                @endforeach
                    </table>
                </div>
            </div>
        {!! Form::close() !!}


    </div>
@endsection