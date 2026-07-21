<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(1);
        return view("users.index",[
            "users"=> $users
        ]);
    }
    public function show($name){
        $user = User::where('name', 'like', "%$name")->first();
        return view("users.show",[
            "user" => $user
        ]);

    }
    public function create(){
        return view("users.create");
    }
    public function store(Request $request){
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]
        );
        return redirect()->route('users.index');
    }

}
