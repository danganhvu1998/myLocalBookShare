@extends('layouts.admin')

@section('content')
    {!! Form::open(['action' => 'AdminBooksController@editBook', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <input type="hidden" name="book_id" value="{{$book->id}}">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.bookName')}}</span>
            </div>
            <input type="text" value="{{$book->name}}" name="name" placeholder="{{__('messages.bookName')}}" class="form-control">
            {{Form::select('language', ["ja" => "Japanese", "en" => 'English', "vi" => 'Vietnamese'], $book->language)}}
            
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.author')}}</span>
            </div>
            <input type="text" value="{{$book->author}}" name="author" placeholder="{{__('messages.author')}}" class="form-control">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.quality')}}</span>
            </div>
            <input type="text" value="{{$book->quality}}" name="quality" placeholder="{{__('messages.quality')}}" class="form-control">
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.image')}}</span>
            </div>
            <input type="text" value="{{$book->image}}" name="image" placeholder="{{__('messages.image')}}" class="form-control">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.intro')}}</span>
            </div>
            <textarea  class="form-control" name="intro" rows="3" placeholder="{{__('messages.intro')}}">{{$book->intro}}</textarea>
        </div>

        {{Form::submit(__('messages.save'), ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
