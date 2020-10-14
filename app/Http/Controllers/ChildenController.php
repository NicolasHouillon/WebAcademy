<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChildenController extends Controller
{

    public function store(Request $request) {
        if(!$request->get('child')) {
            return abort(403);
        } else {
            DB::table('children')->insert([
                'parent_id' => Auth::id(),
                'child_id' => $request->get('child')
            ]);
            return back()->with('success', "Vous avez bien ajouté votre enfant.");
        }
    }

    public function destroy(User $child) {
        DB::table('children')->where([
            'parent_id' => Auth::id(),
            'child_id' => $child->id
        ])->delete();
        return back()->with('success', "Vous avez bien supprimé cet utilisateur.");
    }

}
