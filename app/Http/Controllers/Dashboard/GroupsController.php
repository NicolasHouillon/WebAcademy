<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;

class GroupsController extends Controller
{

    public function index()
    {
        return view('admin.groups.index', [
            'groups' => Group::orderBy('id', 'desc')->get()
        ]);
    }

    public function edit(Group $group)
    {
        return view('admin.groups.edit', [
            'group' => $group
        ]);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->name = $request->get('name');
        $group->save();
        return redirect()->route('admin.groups.index')->with('success', "Le groupe a bien été mis à jour.");
    }

}
