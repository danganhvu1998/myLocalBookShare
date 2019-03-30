<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editInformationsSite(){
        $data = array(
            "user" => Auth::user(),
        );
        return view("users.edit")->with($data);
    }

    public function editInformations(request $request){
        User::where("id", Auth::user()->id)
            ->update([
                "name" => $request->name,
                "language" => $request->language,
            ]);
        
    }
    public function editImage(request $request){
        $this->validate($request, [
            'file' => 'max:1999|image'
        ]);

        if($request->hasFile('file')){
            // Filename to store
            $fileNameToStore = Auth::user()->id.".jpg";
            // Upload File
            $path = $request->file('file')->storeAs('public/user_image/', $fileNameToStore);
        }
        User::where("id", Auth::user()->id)
        ->update([
            "image" => '/storage/user_image/'.$fileNameToStore,
        ]);
        return back()->with("message", "messages.success");
    }

    public function editPassword(request $request){
        $request->validate([
            'curr_pass' => 'required',
            're_new_pass' => 'required|min:6',
            'new_pass' => 'required|min:6',
        ]);

        if($request->new_pass != $request->re_new_pass){
            return back()->withErrors("messages.newPassDoesNotMatch");
        }

        if(!Hash::check($request->curr_pass, Auth::user()->password)){
            return back()->withErrors("messages.wrongPassword");
        }
        // Working on return error if oldPassword is wrong

        $userID = Auth::user()->id;
        User::where("id", $userID)
            ->update([
                "password" => Hash::make($request->new_pass)
            ]);
        return back()->with("message", "messages.success");

    }

}
