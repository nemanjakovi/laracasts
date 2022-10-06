<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


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
            'username' => ['required', 'max:250', 'min:3'],
            'email' => ['required', 'email', 'max:250'],
            'password' => ['required', 'max:250', 'min:7']

        ]);

        User::create($atributes);
        return redirect('/');
    }
}
