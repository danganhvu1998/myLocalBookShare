@extends('layouts.admin')

@section('content')
    @if ($reservation==NULL or $reservation->status==2)
        <h1>You Are Not Reserving Any Book!</h1>
    @else
        <h3 class="text-center">{{__("messages.code")}}: <b class="bg-info"> {{$book->id}}/{{$reservation->borrow_time}} </b></h3>
        <br><br>
        <hr>
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
                @if ($reservation->status==0)
                    <p><b class="text-info">{{__("messages.5DayContact")}}</b></p>
                    <p>{{__("messages.or")}}</p>
                    <a href="/cancel_reserve" class="btn btn-danger">{{__("messages.cancelReserve")}}</a>
                @else
                    <b class="text-info">{{__("messages.borrowedAt")}} </b>
                    <b class="text-danger">{{$reservation->created_at}}</b>
                    <b class="text-info">. {{__("messages.returnIn20Days")}}</b>
                @endif
            </div>
            <div class="col-md-6">
                {{$book->intro}}
            </div>
        </div>
        <hr>
    @endif

@endsection