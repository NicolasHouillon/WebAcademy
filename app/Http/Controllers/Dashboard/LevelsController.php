<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Models\Level;

class LevelsController extends Controller
{

    public function index()
    {
        return view('admin.levels.index', [
            'levels' => Level::orderBy('id', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.levels.create');
    }

    public function store(LevelRequest $request)
    {
        $level = new Level;
        $level->name = $request->get('name');
        $level->school_level = $request->get('place');
        $level->save();
        return redirect()->route('admin.levels.index')->with('success', "Le niveau $level->name a bien été crée.");
    }

    public function edit(Level $level)
    {
        return view('admin.levels.edit', [
            'level' => $level
        ]);
    }

    public function update(LevelRequest $request, Level $level)
    {
        $level->name = $request->get('name');
        $level->school_level = $request->get('place');
        $level->save();
        return redirect()->route('admin.levels.index')->with('success', "Le niveau a bien été mis à jour.");
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.levels.index')->with('success', "Le niveau a bien été supprimé.");
    }

}
