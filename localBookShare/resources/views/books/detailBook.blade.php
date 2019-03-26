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
            <hr>
            <b>From Admin: </b>{{$adminComment}}
        </div>
    </div>
    @guest
    @else
        <hr>
        @if (Auth::user()->point<6)
            <div class="text-center text-danger">
                {{__("messages.notEnoughPointToComment")}}
            </div>
            <hr>
        @else
            <div id="comment_section">
                {!! Form::open(['action' => "CommentsController@addComment", 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="input-group mb-3">
                        <input type="hidden" name="book_id" value="{{$book->id}}">
                        <div class="input-group-prepend">
                            <img src="{{ Auth::user()->image }}" width="70" height="auto" alt="Image Error">
                        </div>
                        
                        <textarea name="content" cols="30" class="form-control"></textarea>
                        {{Form::submit(__('messages.add'), ['class' => 'btn btn-outline-primary'])}}
                    </div>
                {!! Form::close() !!}
            </div>    
        @endif
        <div id="show_comments">
            @foreach ($comments as $comment)
                <div class="row">
                    <div class="col-md-1">
                        <img src="{{$comment->image}}" width="70%" alt="">
                    </div>
                    <div class="col-md-11">
                        <b>{{$comment->name}}</b><br>
                        {{$comment->content}}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    @endguest
@endsection