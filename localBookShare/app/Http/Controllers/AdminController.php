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

    public function index(){
        return view('admins.index');
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
            return redirect("/admin/all_books/1/all")->with("message", "messages.success");
        }
    }

    public function allBooksSite($page, $language){
        if($language=="all"){
            $lang = ["vi", "en", "ja"];
        } else {
            $lang = [$language];
        }
        $bookNumberDisplace = 30;
        $books = Book::whereBetween('id', [($page-1)*$bookNumberDisplace+1, $page*$bookNumberDisplace])
            ->whereIn('language', $lang)
            ->select("id", "name", "author", "image", "language", "quality")
            ->get();
        $data = array(
            "books" => $books,
        );
        return view('admins.allBooks')->with($data);
    }

    public function editBookSite($book_id){
        $book = Book::where('id', $book_id)->first();
        $data = array(
            "book" => $book,
        );
        return view('admins.editBook')->with($data);
    }

    public function editBook(request $request){
        Book::where("id", $request->book_id)
            ->update([
                "name" => $request->name,
                "author" => $request->author,
                "language" => $request->language,
                "image" => $request->image,
                "quality" => $request->quality,
                "intro" => $request->intro,
            ]);
        return redirect("/admin/all_books/1/all")->with("message", "messages.success");
    }
}