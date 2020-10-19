<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index() {
        return view('admin.home', [
            'notifications' => DB::table('notifications')->where([
                'type' => 'App\Notifications\CourseCreate',
                'read_at' => null
            ])->count()
        ]);
    }

}
