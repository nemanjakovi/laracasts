<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {

        $atributes =  request()->validate([
            'name' => ['required', 'max:250'],
            'username' => ['required', 'min:3', 'max:250', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:250', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:250']

        ]);

        $user = User::create($atributes);

        auth()->login($user);

        return redirect('/')->with('success', 'Your acount has been created');;
    }
}
