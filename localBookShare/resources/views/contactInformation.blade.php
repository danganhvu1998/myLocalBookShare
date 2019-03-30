@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="{{$admin->image}}" alt="" width="100%">
            <hr>
            <b>Name: {{$admin->name}}</b><br>
            <b>Language: Vietnamese, English</b><br>
            <hr>
            <a href="https://www.iniad.org/"><b>University: INIAD - Information Networking for Innovation And Design</b></a>
        </div>
        <div class="col-md-8 text-center">
            <hr>
                <img src="/system/contact_line.ico" alt="" height="30" width="30"> 
                <span>ID: duongtinhvu</span> 
            <hr>
                <img src="/system/contact_skype.png" alt="" height="30" width="30">  <span>danganhvu1998@gmail.com</span>
            <hr>
                <img src="/system/contact_email.png" alt="" height="30" width="30">  <span>danganhvu1998@gmail.com</span>
            <hr>
                <img src="/system/contact_linkedin.png" alt="" height="30" width="30">  
                <span><a href="https://www.linkedin.com/in/anh-vu-dang-68b60014a/">Anh Vu Dang</a></span>
            <hr>
                <b>{{__("messages.bestContactWay")}}</b>
                <img src="/system/line_qr.jpg" alt="" height="200" width="200">
        </div>
    </div>
    <hr>
@endsection
