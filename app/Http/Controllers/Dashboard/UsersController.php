<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        return view('admin.users.index', [
            'users' => User::orderBy('id', 'desc')->get()
        ]);
    }

    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'groups' => Group::all()
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->group_id = $request->get('group_id');
        $user->password = Hash::make($request->get('password'));

        if ($user->avatar !== $request->get('avatar') && $request->has('avatar'))
            $user->avatar = $request->get('avatar');

        $user->save();

        return redirect()->route('admin.users.index')->with('success', "L'utilisateur a bien été modifié.");
    }

    public function create()
    {
        return view('admin.users.create', [
            'groups' => Group::all()
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->group_id = $request->get('group_id');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "L'utilisateur a bien été créer.");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', "L'utilisateur a bien été supprimé.");
    }

}
