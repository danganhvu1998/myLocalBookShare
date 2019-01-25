<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;


class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['checkAdmin']);
    }

    public function allUsersSite(){
        $users = User::all();
        $data = array(
            "users" => $users,
        );
        return view("admins.users.allUsers")->with($data);
    }

    public function resetPassword(request $request){
        #reset_account_email
        $_max = PHP_INT_MAX - 5;
        $_min = -$_max;
        $rand = random_int($_min, $_max);
        $newPass = Hash::make($rand);
        User::where("email", $request->reset_account_email)
            ->update([
                "password" => Hash::make($newPass),
                "remember_token" => "deleted_token",
            ]);
        return back()->with("message", $newPass);
    }

}
