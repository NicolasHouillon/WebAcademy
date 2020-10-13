<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;

class SubjectsController extends Controller
{

    public function index()
    {
        return view('admin.subjects.index', [
            'subjects' => Subject::orderBy('id', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(SubjectRequest $request)
    {
        $subject = new Subject;
        $subject->name = $request->get('name');
        $subject->slug = strtolower(str_replace(" ", "_", $request->get('name')));
        $subject->save();
        return redirect()->route('admin.subjects.index')->with('success', "La matière $subject->name a bien été crée.");
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', [
            'subject' => $subject
        ]);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->name = $request->get('name');
        $subject->save();
        return redirect()->route('admin.subjects.index')->with('success', "La matière a bien été mise à jour.");
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', "La matière a bien été supprimée.");
    }

}
