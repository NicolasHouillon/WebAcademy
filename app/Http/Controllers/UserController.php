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
        $coursSuivis = [];
        $cours = [];

        if (Auth::user()->slugFullName() == $name) {
            $user = Auth::user();
        } else {
            $data = explode("_", $name);
            $user = User::where([
                'firstname' => $data[0],
                'lastname' => $data[1]
            ])->first();
        }

        if (Auth::check() && $user->group_id==4){
            foreach ($user->followed as $cours) {
                array_push($coursSuivis,$cours);
            }
        }

        if (Auth::check() && $user->group_id==2){
            foreach ($user->courses as $c) {
                array_push($cours,$c);
            }
        }


        return view('users.show', [
            'mesCours' => $cours,
            'coursSuivis' => $coursSuivis,
            'user' => $user]);
    }
}
