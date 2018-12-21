<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Book;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['checkAdmin']);
    }

    public function addBookSite(){
        return view('admins.addBook');
    }

    public function addBook(request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $book = new Book;
        $book->name = $request->name;
        $book->language = $request->language;
        $book->author = $request->author;
        $book->quality = $request->quality;
        $book->image = $request->image;
        $book->intro = $request->intro;
        $result =$book->save();
        if($result){
            return "OK";
        }
    }
}