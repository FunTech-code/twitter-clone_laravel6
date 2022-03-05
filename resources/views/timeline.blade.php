@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        {!! Form::open(['route' => 'timeline', 'method' => 'POST']) !!}
            {{ csrf_field() }}
            <div class="row mb-4">
                @guest
                <div class="col-sm-12">
                    <table class="table table-bordered">
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
                    {{ Form::file('image_url', ['id'=>'image_url']) }}
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