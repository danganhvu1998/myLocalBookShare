@extends('layouts.admin')

@section('content')
    {!! Form::open(['action' => 'AdminReservationsController@checkReservationByCode', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="input-group mb-3">
            <input type="text" name="reservation_code" class="form-control">
            {{Form::submit(__('messages.check'), ['class' => 'btn btn-outline-primary'])}}
        </div>
        
    {!! Form::close() !!}
@endsection