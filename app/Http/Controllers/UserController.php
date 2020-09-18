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
        if (Auth::user()->slugFullName() == $name) {
            $user = Auth::user();
        } else {
            $data = explode("_", $name);
            $user = User::where([
                'firstname' => $data[0],
                'lastname' => $data[1]
            ])->first();
        }

        $return = $user ? ['user' => $user] : ['error' => "L'utilisateur n'existe pas."];
        return view('users.show', $return);
    }
}
