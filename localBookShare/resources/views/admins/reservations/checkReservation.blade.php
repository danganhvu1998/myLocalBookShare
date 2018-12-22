@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-5 text-center">
            <img src="{{$book->image}}" alt="{{$book->name}}" width="100%">
        </div>
        <div class="col-md-7 text-center">
            <b>{{$book->name}}</b><br>
            deposit: <b class="text-danger">{{$reservation->borrow_money}}￥</b><br>
            donate: <b class="text-danger">{{$reservation->donate_money}}￥</b><br>
            
            <br>
            <hr>
            <br>

            When giving book, take
            @if ($reservation->borrow_money>$reservation->donate_money)
                <b class="text-danger">{{$reservation->borrow_money}}￥</b><br>
            @else
                <b class="text-danger">{{$reservation->donate_money}}￥</b><br>
            @endif
            When taking back book, give
            @if ($reservation->borrow_money>$reservation->donate_money)
                <b class="text-danger">{{$reservation->borrow_money-$reservation->donate_money}}￥</b><br>
            @else
                <b class="text-danger">0￥</b><br>
            @endif

            <br>
            <hr>
            <br>

            <h5 class="text-info"><b>###*** START_IMPORTANT ***###</b></h5>
            <br>
            <h4>
                @if ($reservation->status==0)
                    <b>Give book, and TAKE</b>
                    @if ($reservation->borrow_money>$reservation->donate_money)
                        <b class="text-danger">{{$reservation->borrow_money}}￥</b><br>
                    @else
                        <b class="text-danger">{{$reservation->donate_money}}￥</b><br>
                    @endif
                @else
                    <b> Take book, and GIVE</b>
                    @if ($reservation->borrow_money>$reservation->donate_money)
                        <b class="text-danger">{{$reservation->borrow_money-$reservation->donate_money}}￥</b><br>
                    @else
                        <b class="text-danger">0￥</b><br>
                    @endif
                @endif
            </h4>
            <a href="" class="btn btn-warning"><b>DONE</b></a><br><br>
            
            <h5 class="text-info"><b>###*** END_IMPORTANT ***###</b></h5>
        </div>
    </div>
@endsection