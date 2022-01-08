<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
       $attributes =  request()->validate([
            'name'=>'required',
            'email'=>'required|email|max:20|unique:users,email',
            'password'=>'required|min:6|max:20',
            'username'=>'required|max:30|unique:users,username'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

       $user = User::create($attributes);
       Auth()->login($user);

        session()->flash('success', 'your account has been created!');

        redirect('/')->with('success','your account has been created!');
    }
}
