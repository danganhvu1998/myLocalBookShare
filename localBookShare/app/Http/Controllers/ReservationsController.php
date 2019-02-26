<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Book;
use App\Reservation;
use App\User;

class ReservationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reserveBookAccept($book_id){
        Book::where("id", $book_id)
            ->update([
                "status" => 0
            ]);

        User::where("id", Auth::user()->id)
            ->update([
                "status" => 0
            ]);
        
        $reservation = new Reservation;
        if(Auth::user()->point>9){
            $reservation->borrow_money = 0;
        } else {
            #$reservation->borrow_money = 1000;
            $reservation->borrow_money = 0;
        }
        $reservation->book_id = $book_id;
        $reservation->user_id = Auth::user()->id;
        $reservation->status = 0;
        $reservation->borrow_time = time();
        $reservation->save();
        return "OK";
    }

    public function reserveBook($book_id){
        #return redirect("/all_books/1/all")->withErrors("Chức năng tạm đóng đến khi mình quay trở lại Nhật Bản ngày 1 tháng 3 2019 :) Thân!");
        if(Auth::user()->status==0){
            return back()->withErrors("messages.reserveFailBecauseAlreadyReservingBook");
        }

        $book = Book::where("id", $book_id)->first();
        if($book->status==0){
            return back()->withErrors("messages.reserveFailBecauseThisBookIsNotAvailable");
        }
        $this->reserveBookAccept($book_id);
        return redirect("/reserving_info")->with("message", "messages.reserveSuccess");
    }

    public function cancelReserveBookAccepted($reservation){
        Reservation::where("id", $reservation->id)
            ->delete();
        
        Book::where("id", $reservation->book_id)
            ->update([
                "status" => 1
            ]);

        User::where("id", $reservation->user_id)
            ->update([
                "status" => 1
            ]);
    }

    public function cancelReserveBook(){
        $reservation = Reservation::where("user_id", Auth::user()->id)
            ->orderBy("id", "desc")
            ->first();
        
        if($reservation==NULL or $reservation->status==2){
            return back()->withErrors("messages.notBorrowingBook");
        } else if($reservation->status==1){
            return back()->withErrors("messages.cannotCancelWhileKeepingBook");
        } else {
            $this->cancelReserveBookAccepted($reservation);
            return back()->with("message", "messages.cancelReservationSuccess");
        }
    }

    public function reservingInfoSite(){
        $reservation = Reservation::where("user_id", Auth::user()->id)
            ->where("status", "<", 2)
            ->orderBy("id", "desc")
            ->first();
        if($reservation==NULL){
            return redirect("/all_books/1/all");
        }
        $book = Book::where("id", $reservation->book_id)->first();
        $data = array(
            "reservation" => $reservation,
            "book" => $book,
        );
        return view("reservations.reservingInfo")->with($data);
    }

    public function reservingDonation(request $request){
        $reservation = Reservation::where("user_id", Auth::user()->id)
            ->where("status", 0)
            ->first();
        if($reservation==NULL){
            return back()->withErrors("messages.invalid");
        } else if($request->donate_money<0){
            return back()->withErrors("messages.invalid");
        } else {
            Reservation::where("id", $reservation->id)
                ->update([
                    "donate_money" => $request->donate_money,
                ]);
            return back()->with("message", "messages.thankForYourKindness");
        }
    }
}
