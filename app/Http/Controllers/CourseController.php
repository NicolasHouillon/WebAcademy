<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('courses.create', [
            'subjects' => Subject::all(),
            'levels' => Level::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CourseRequest $request)
    {
        $course = new Course;
        $course->name = $request->get('name');
        $course->description = $request->get('description');
        $course->price = $request->get('price');
        $course->subject_id = $request->get('subject_id');
        $course->level_id = $request->get('level_id');
        $course->user_id = Auth::id();
        $course->save();

        if($request->hasFile('uploads')) {
            foreach ($request->uploads as $file) {
                dd($file);
                $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/uploads';
                $file->save($path, $name);
            }
        }

        return redirect()->route('courses_index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $course = Course::where('id', $id)->first();
        $return = $course ? ['course' => $course] : ['error' => "Le cours demandé n'existe pas."];
        return view('courses.show', $return);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return void
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Course $course
     * @return void
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return void
     */
    public function destroy(Course $course)
    {
        //
    }
}
