<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('sessions.create');
    }

    public function destroy()
    {
        auth()->logout();
        redirect('/')->with('success','Good By!');
    }

    public function store()
    {
        $attributes= request()->validate([
            'email'=>'max:255|required|exists:users,email',
            'password'=>'min:6|max:20|required'
        ]);

        if(auth()->attempt($attributes)){
            return redirect('/')->with('success','Welcome Back!');
        }

        throw ValidationException::withMessages([
            'email'=>'wrong email address!'
        ]);
//        return back()
//                  ->withInput()
//                  ->withErrors(['email'=>'wrong email address!']);
    }
}
