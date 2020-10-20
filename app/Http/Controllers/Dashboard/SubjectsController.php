<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function uploadImage(Request $request,Subject $subject) {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')){
            $img = $request->file('image');
            $extension = $img->getClientOriginalExtension();
            Storage::disk('public')->put("subject/".$subject->id."/".$img->getFilename().'.'.$extension,  File::get($img));
            $subject->url = "storage/subject/".$subject->id."/".$img->getFilename().'.'.$extension;
            $subject->save();
        }

        return redirect()->back();

    }

}
