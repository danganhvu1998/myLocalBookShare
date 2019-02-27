@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-5" >
                        <img src="{{$book->image}}" alt="Book's Image" width="100%">
                    </div>
                    <div class="col-md-7">
                        <a href="/detail_book/{{$book->id}}"> 
                            <h4><b class="text-info">{{$book->name}}</b></h4>
                        </a>
                        {{__("messages.author")}}: <b>{{$book->author}}</b><br>
                        {{__("messages.language")}}: <b>{{$book->language}}</b><br>
                        <hr>
                        @guest
                            <a href="/login" class="btn btn-primary">{{__("messages.loginToBorrow")}}</a>
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
                </div>
            </div>
            @if ($loop->index%3==2)
                </div><hr><div class="row">
            @endif
        @endforeach
    </div>
    <br><br>
    <div class="col-lg-10 text-center">
        <a href="/all_books/1/{{$language}}" class="btn btn-primary">1</a>
        <div class="btn-group">
            <a href="/all_books/{{$pageNum-2}}/{{$language}}" class="btn btn-primary"><<</a>
            <a href="/all_books/{{$pageNum-1}}/{{$language}}" class="btn btn-primary"><</a>
            <a class="btn btn-info"><b>Current Page: {{$pageNum}}</b></a>
            <a href="/all_books/{{$pageNum+1}}/{{$language}}" class="btn btn-primary">></a>
            <a href="/all_books/{{$pageNum+2}}/{{$language}}" class="btn btn-primary">>></a>
            <a href="/all_books/{{$pageNum+5}}/{{$language}}" class="btn btn-primary">+5 Pages</a>
            <a href="/all_books/{{$pageNum+10}}/{{$language}}" class="btn btn-primary">+10 Pages</a>
        </div>
    </div> 

@endsection