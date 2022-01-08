<?php

namespace App\Http\Controllers;

use App\Services\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsLetterController extends Controller
{
    public function __invoke(NewsLetter $newsletter)
    {

        request()->validate(['email' => 'email|required']);


        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'this email is not add successfully!'
            ]);
        }


        return redirect('/')->with('success', 'you are successfully registred to our newsletter!');
    }
}
