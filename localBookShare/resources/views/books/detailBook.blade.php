@extends('layouts.app')

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
            @guest
                <a href="" class="btn btn-success disabled">{{__("messages.loginToBorrow")}}</a>
            @else
                @if ($book->status)
                    @if (Auth::user()->status==1)
                        <a href="/reserve/{{$book->id}}" class="btn btn-success">{{__("messages.borrowNow")}}</a>
                    @else
                        <a href="" class="btn btn-info disabled">{{__("messages.cannotBorrowMore")}}</a>
                    @endif
                @else
                    <a href="" class="btn btn-danger disabled">{{__("messages.notAvailable")}}</a>
                @endif
            @endguest
        </div>
        <div class="col-md-6">
            {{$book->intro}}
        </div>
    </div>
@endsection