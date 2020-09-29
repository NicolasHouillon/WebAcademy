<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * @var GroupService
     */
    private $groupService;

    /**
     * Create a new controller instance.
     *
     * @param GroupService $groupService
     */
    public function __construct(GroupService $groupService)
    {
        $this->middleware('auth');
        $this->groupService = $groupService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home', [
            'teachers' => $this->groupService->getUsersForGroup("Professeur")
        ]);
    }

}
