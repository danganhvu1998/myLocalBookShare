@extends('layouts.admin')

@section('content')
    {!! Form::open(['action' => 'AdminController@addBook', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.bookName')}}</span>
            </div>
            <input type="text" name="name" placeholder="{{__('messages.bookName')}}" class="form-control">
            <select name="language">
                <option value="en">English</option>
                <option value="vi">Vietnamese</option>
                <option value="ja">Japanese</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.author')}}</span>
            </div>
            <input type="text" name="author" placeholder="{{__('messages.author')}}" class="form-control">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.quality')}}</span>
            </div>
            <input type="text" name="quality" placeholder="{{__('messages.quality')}}" class="form-control">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.image')}}</span>
            </div>
            <input type="text" name="image" placeholder="{{__('messages.image')}}" class="form-control">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.intro')}}</span>
            </div>
            <textarea  class="form-control" name="intro"rows="3" placeholder="{{__('messages.intro')}}"></textarea>
        </div>

        {{Form::submit(__('messages.save'), ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
