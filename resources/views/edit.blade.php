@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EdidUser') }}</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'editcomplete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                    
                    {{ Form::label('name','氏名')}}
                    {{ Form::text('name', $user->name, ['id'=>'name','class' => 'form-control mr-auto']) }}
                    
                    {{ Form::label('email','Eメール')}}
                    {{ Form::text('email', $user->email, ['id'=>'email','class' => 'form-control mr-auto']) }}
                    
                    {{Form::label('tel_number','電話番号')}}
                    {{ Form::text('tel_number', $user->tel_number, ['id'=>'tel_number','class' => 'form-control mr-auto']) }}
                    
                    {{ Form::label('image_url','アイコン画像')}}
                    {{ Form::file('image_url', ['id'=>'image_url','class' => 'form-control mr-auto']) }}
                    
                    {{ Form::label('profile','プロフィール')}}
                    {{ Form::text('profile', $user->profile, ['id'=>'profile','class' => 'form-control mr-auto']) }}
                    {{ Form::submit('EditUser', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
