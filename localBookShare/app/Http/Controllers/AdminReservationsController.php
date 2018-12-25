<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Book;
use App\Reservation;
use App\User;

class AdminReservationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['checkAdmin']);
    }

    public function checkReservationSite($book_id, $code){
        $reservation = Reservation::where("borrow_time", $code)
            ->where("book_id", $book_id)
            ->where("status", "<", 2)
            ->first();
        if($reservation==NULL){
            return redirect("/admin/check_reservation_code")->withErrors("message.notFound");
        }
        $book = Book::where("id", $book_id)->first();
        $data = array(
            "reservation" => $reservation,
            "book" => $book,
        );
        return view("admins.reservations.checkReservation")->with($data);
    }

    public function checkReservationByCode(request $request){
        if(!strpos($request->reservation_code, "/")){
            return redirect("/admin/check_reservation_code")->withErrors("message.notFound");
        }
        return redirect("/admin/check_reservation_code/".$request->reservation_code);
    }

    public function checkReservationByCodeSite(){
        return view("admins.reservations.inputCode");
    }

    public function reservationNextStatus($reservation){
        if($reservation->status==1){
            Book::where("id", $reservation->book_id)
                ->update([
                    "status" => 1
                ]);
            $user = User::where("id", $reservation->user_id)->first();
            User::where("id", $reservation->user_id)
                ->update([
                    "status" => 1
                ]);
            if($user->point<15){
                User::where("id", $reservation->user_id)
                    ->increment('point');
            }
        }
        Reservation::where("id", $reservation->id)
            ->update([
                "status" => $reservation->status+1
            ]);
    }

    public function declineReservation($reservation){
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

    public function checkReservationByCodeResult(request $request){
        $reservation = Reservation::where("id", $request->reservation_id)->first();
        $result = strtolower($request->result);
        
        if($result=="accept"){
            $result = 1;
        } else if($result=="decline"){
            $result = 0;
        } else {
            return back()->withErrors("messages.cannotUnderstand");
        } 

        if($reservation->status==2){
            return back()->withErrors("messages.alreadyFinished");
        } else if($reservation->status==1 and $result==0){
            return back()->withErrors("messages.cannotDecline");
        } else if($reservation->status==0 and $result==0){
            $this->declineReservation($reservation);
            return redirect("/admin/check_reservation_code")->with("message", "messages.successfulDeclined");
        } else {
            $this->reservationNextStatus($reservation);
            return redirect("/admin/check_reservation_code")->with("message", "messages.successfulAccepted");
        }
    }
}
