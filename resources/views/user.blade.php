@extends('layouts.app')

@section('content')
    <div class="container mt-3">
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