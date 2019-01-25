@extends('layouts.admin')

@section('content')
    {!! Form::open(['action' => 'AdminReservationsController@checkReservationByCode', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="input-group mb-3">
            <input type="text" name="reservation_code" class="form-control">
            {{Form::submit(__('messages.check'), ['class' => 'btn btn-outline-primary'])}}
        </div>
        
    {!! Form::close() !!}
    <hr>
    <div class="row text-center">
        @foreach ($currReservations as $reservation)
            <div class="col-md-2">
                <img src="{{$reservation->book_image}}" alt="Book's Image" width="100%">
            </div>
            <div class="col-md-8">
                Book Name: <b>{{$reservation->book_name}}</b><br><br>
                User Name: <b>{{$reservation->user_name}}</b><br>
                User Email: <b>{{$reservation->email}}</b><br><br>
                Time Start: <b>{{$reservation->created_at}}</b><br><br>
                @if ($reservation->borrow_time<$timeCheck)
                    <b class="text-danger bg-warning">OVERDUE OVERDUE OVERDUE</b></div>
                    <div class="col-md-2 bg-danger">
                        <br><br>
                        <img src="{{$reservation->user_image}}" alt="Book's Image" width="100%">
                    </div>
                @else
                    <b class="text-success">NO PROBLEM</b></div>
                    <div class="col-md-2 bg-success">
                        <br><br>
                        <img src="{{$reservation->user_image}}" alt="Book's Image" width="100%">
                    </div>
                @endif

        @endforeach
    </div>
@endsection