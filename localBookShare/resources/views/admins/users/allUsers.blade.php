@extends('layouts.admin')
@section('content')
    
    {!! Form::open(['action' => 'AdminUsersController@resetPassword', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="input-group mb-3">
            <input type="text" name="reset_account_email" class="form-control">
            {{Form::submit(__('messages.resetPassword'), ['class' => 'btn btn-outline-primary'])}}
        </div>
    {!! Form::close() !!}

    <div class="row text-center">
        @foreach ($users as $user)
                <div class="col-md-2">
                    <img src="{{$user->image}}" alt="{{$user->image}}"  width="100%">
                </div>
                <div class="col-md-4">
                    <strong>{{$user->name}}</strong><br>
                    {{$user->email}}<br><br>
                    Status: <b>{{$user->status}}</b><br>
                    Point: <b>{{$user->point}}</b>
                </div>
        @endforeach
    </div>

@endsection