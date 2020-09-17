<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show(string $name)
    {
        if (Auth::user()->name == $name) {
            $user = Auth::user();
        } else {
            $user = User::where('name', $name)->first();
        }

        $return = $user ? ['user' => $user] : ['error' => "L'utilisateur n'existe pas."];
        return view('users.show', $return);
    }
}
