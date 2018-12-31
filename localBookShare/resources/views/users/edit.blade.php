@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{Auth::user()->image}}" alt="Image Cannot Be Displace" width="100%">
            Name: <b>{{Auth::user()->name}}</b><br>
            Email: <b>{{Auth::user()->email}}</b><br>
        </div>
        <div class="col-md-8">
            {!! Form::open(['action' => 'UsersController@editInformations', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{__('messages.name')}}</span>
                    </div>
                    <input type="text" value="{{Auth::user()->name}}" name="name" placeholder="{{__('messages.name')}}" class="form-control">
                    {{Form::select('language', ["ja" => "Japanese", "en" => 'English', "vi" => 'Vietnamese'], Auth::user()->language)}}
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{__('messages.imageLink')}}</span>
                    </div>
                    <input type="text" value="{{Auth::user()->image}}" name="image" placeholder="{{__('messages.imageLink')}}" class="form-control">
                </div>

                {{Form::submit(__('messages.save'), ['class' => 'btn btn-outline-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
