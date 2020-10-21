<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $subject = Subject::all();
        return view('home', ['subjects' => $subject]);
    }

    /**
     * @return Application|Factory|View
     */
    public function contact() {
        return view('contact');
    }

    /**
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function sendContact(ContactRequest $request) {
        $admin = User::where('group_id', 1)->get('email');
        foreach ($admin  as $ad) {
            Mail::to($ad)
                ->send(new ContactMail(
                    $request->get('firstname') . " " . $request->get('lastname'),
                    $request->get('email'),
                    $request->get('message')
                ))
            ;
        }
        return back()->with('success', 'Votre message a bien été envoyé.');
    }

}
