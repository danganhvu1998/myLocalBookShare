@extends('layouts.app')

@section('content')
    @if ($messenger_id)
        <b>Your account has been linked to </b>
        <a href="https://www.facebook.com/{{$messenger_id}}">this facebook account</a>!
    @else
        <b>Your account has not been linked to any facebook account. To connect, follow these steps:</b>
        <ul>
            <li>
                Connect with us in facebok by sending friend request to 
                <a href="https://www.facebook.com/local.bookshare.9">this facebook account</a>
            </li>
            <li>
                Send us this message: "  <h3 class="text-danger">order account confirm {{$random_link}}</h3>  "
            </li>
            <li>Thank you!</li>
        </ul>
        
    @endif
@endsection

