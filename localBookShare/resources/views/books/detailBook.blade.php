@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <img src="{{$book->image}}" alt="Book's Image" width="100%">
        </div>
        <div class="col-md-3">
            <a href="/detail_book/{{$book->id}}"> 
                <h4><b class="text-info">{{$book->name}}</b></h4>
            </a>
            {{__("messages.author")}}: <b>{{$book->author}}</b><br>
            <hr>
            {{__("messages.quality")}}: <b>{{$book->quality}}</b><br>
            {{__("messages.language")}}: <b>{{$book->language}}</b><br>
            <hr>
            @if ($book->status)
                <a href="/reserve/{{$book->id}}" class="btn btn-success">{{__("messages.borrowNow")}}</a>
            @else
                <a href="" class="btn btn-danger disabled">{{__("messages.notAvailable")}}</a>
            @endif
        </div>
        <div class="col-md-6">
            {{$book->intro}}
        </div>
    </div>
@endsection