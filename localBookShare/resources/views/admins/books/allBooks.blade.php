@extends('layouts.admin')

@section('content')
    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{$book->image}}" alt="Book's Image" width="100%">
                    </div>
                    <div class="col-md-8">
                        <a href="/admin/edit_book/{{$book->id}}"> 
                            <h4><b class="text-info">{{$book->name}}</b></h4>
                        </a>
                        {{__("messages.author")}}: <b>{{$book->author}}</b><br>
                        <hr>
                        {{__("messages.quality")}}: <b>{{$book->quality}}</b><br>
                        {{__("messages.language")}}: <b>{{$book->language}}</b><br>
                        <hr>
                        {{__("messages.status")}}:
                    </div>
                </div>
            </div>
            @if ($loop->iteration%2==0)
                </div><br><div class="row">
            @endif
        @endforeach
    </div>

@endsection