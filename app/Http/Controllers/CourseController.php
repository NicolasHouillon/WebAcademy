<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Attachment;
use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
use App\Services\GroupService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CourseController extends Controller
{

    private $groupService;

    /**
     * CourseController constructor.
     * @param GroupService $groupService
     */
    public function __construct(GroupService $groupService)
    {
        $this->middleware('auth');
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Course::class);

        $courses = Course::orderBy('id', 'desc');
        $this->sortCourses($courses, $request);

        return view('courses.index', [
            'courses' => $courses->get(),
            'subjects' => Subject::all(),
            'levels' => Level::all(),
            'teachers' => $this->groupService->getUsersForGroup("Professeur")
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
     * @param Course $course
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(Course $course)
    {
        $this->authorize('view', $course);
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

    private function sortCourses($courses, Request $request)
    {
        if ($request->query('teacher') != "") {
            $courses->where('user_id', $request->get('teacher'));
        }
        if ($request->query('subject') != "") {
            $courses->where('subject_id', $request->get('subject'));
        }
        if ($request->query('level') != "") {
            $courses->where('level_id', $request->get('level'));
        }
    }

    public function uploadFile(Request $request, $id) {

        $user = Auth::user();
        if ($request->hasFile('file')){
            $files = $request->file('file');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                Storage::disk('public')->put("attachement/".$user->id."/".$file->getFilename().'.'.$extension,  File::get($file));
                $attachement = new Attachment();
                $attachement->name = $file->getClientOriginalName();
                $attachement->file = "attachement/".$user->id."/".$file->getFilename().'.'.$extension;
                $attachement->course_id =$id;
                $attachement->save();
            }

        }

        return back();

    }

}
