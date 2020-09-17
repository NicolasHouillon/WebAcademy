<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show(string $name) {
        $user = User::where('name', $name)->first();
        $return = $user ? [$user] : ['error' => "L'utilisateur n'existe pas."];
        return view('users.show', $return);
    }

    public function tableauBord() {
        return view('tableauBord');
    }
}
