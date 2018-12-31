@extends('layouts.app')

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
                    <a href="/contact" class="btn btn-success btn-block">{{__("messages.contactMe")}}</a>
                    <p>{{__("messages.or")}}</p>
                    <a href="/cancel_reserve" class="btn btn-danger btn-block">{{__("messages.cancelReserve")}}</a>
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
        @if ($reservation->status==0)
            <h4 class="text-center"><b class="text-primary">{{__("messages.doYouWantToDonate")}}?</b></h4>
            <div class="row text-center">
                <div class="col-md-7">
                    {{__("messages.donateThisTime")}} <b class="text-danger">{{$reservation->donate_money}}￥</b> <br>
                    @if ($reservation->donate_money>0)
                        (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧ <b>{{__("messages.weThankYou")}}</b>✧ﾟ･: *ヽ(◕ヮ◕ヽ)
                    @endif
                    <hr>
                    <span class="text-muted">{{__("messages.thisIsOptional_AlwayCanChangeBeForeReceveBook")}}</span>
                </div>
                <div class="col-md-5">
                    {!! Form::open(['action' => 'ReservationsController@reservingDonation', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <span class="text-info"><b>{{__("messages.IWantToDonte")}}</b></span>
                        <div class="input-group mb-3">
                            <input type="number" name="donate_money" class="form-control" max="5000" min="0" placeholder="0-5000"> 
                            <span class="input-group-text">￥</span>
                            {{Form::submit(__('messages.accept'), ['class' => 'btn btn-success'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <div class="text-center">
                {{__("messages.youDonatedThisTime")}} <b class="text-danger">{{$reservation->donate_money}}￥</b> <br>
                @if ($reservation->donate_money>0)
                    (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧ <b>{{__("messages.weThankYou")}}</b>✧ﾟ･: *ヽ(◕ヮ◕ヽ)
                @endif
            </div>
        @endif
    @endif

@endsection