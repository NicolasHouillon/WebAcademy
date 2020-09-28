<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CourseController extends Controller
{

    /**
     * CourseController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Course::class);
        return view('courses.index', [
            'courses' => Course::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Course::class);
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
     * @throws AuthorizationException
     */
    public function store(CourseRequest $request)
    {
        $this->authorize('create', Course::class);
        $this->storeCourse($request, new Course);
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(int $id)
    {
        $this->authorize('view', Course::class);
        $course = Course::where('id', $id)->first();
        $return = $course ? ['course' => $course] : ['error' => "Le cours demandé n'existe pas."];
        return view('courses.show', $return);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        $return = $course ? [
            'course' => $course,
            'subjects' => Subject::all(),
            'levels' => Level::all()
        ] : [
            'error' => "Le cours n'existe pas."
        ];
        return view('courses.edit', $return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param Course $course
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(CourseRequest $request, Course $course)
    {
        $this->authorize('update', $course);
        $this->storeCourse($request, $course);
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
    }

    private function storeCourse(CourseRequest $request, Course $course)
    {
        $course->name = $request->get('name');
        $course->description = $request->get('description');
        $course->price = $request->get('price');
        $course->subject_id = $request->get('subject_id');
        $course->level_id = $request->get('level_id');
        $course->user_id = Auth::id();
        $course->save();

        if ($request->hasFile('uploads')) {
            foreach ($request->uploads as $file) {
                $name = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/uploads';
                $file->save($path, $name);
            }
        }
    }

}
