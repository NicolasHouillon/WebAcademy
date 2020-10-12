<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;

class CoursesController extends Controller
{

    public function index()
    {
        return view('admin.courses.index', [
            'courses' => Course::orderBy('id', 'desc')->get()
        ]);
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', [
            'course' => $course
        ]);
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', [
            'course' => $course,
            'subjects' => Subject::all(),
            'levels' => Level::all()
        ]);
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->name = $request->get('name');
        $course->description = $request->get('description');
        $course->price = $request->get('price');
        $course->subject_id = $request->get('subject_id');
        $course->level_id = $request->get('level_id');
        $course->save();

        return redirect()->route('admin.courses.index')->with('success', "Le cours a bien été mis à jour.");
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', "Le cours a bien été supprimé.");
    }

}
