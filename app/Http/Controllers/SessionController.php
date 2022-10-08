<?php

namespace App\Http\Controllers;

// use Dotenv\Exception\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }


    public function store()
    {
        $attributes =  request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes)) {
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome back');
        }

        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);

        return back()
            ->withInput()
            ->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }



    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
