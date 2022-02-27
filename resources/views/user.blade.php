@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-sm-3">
                @if (isset($user->image_url))
                    <img src={{ $user->image_url }}><br>
                @else
                    <img src="https://thumb.ac-illust.com/e2/e2cb85acf732de018702298367234d84_t.jpeg" width=100% height=auto><br>
                @endif
            </div>
            <div class="col-sm-5">
                <strong>{{ $user->name }}</strong>
            </div>
            <div class="col-sm-4">
                <div class="mx-auto">
                    <a class="btn btn-primary" href="{{ route('edit') }}">プロフィールを編集する</a>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div>{{ $user->profile }}</div>    
        </div>
        <table class="table table-bordered">
        @foreach ($tweets as $tweet)
            <tr>
                <td>
                    <strong>{{ $user->name }}</strong> {{ $tweet->created_at }}
                    <div>{{ $tweet->tweet }}</div>
                </td>
            <tr>
        @endforeach
        </table>    
    </div>
@endsection