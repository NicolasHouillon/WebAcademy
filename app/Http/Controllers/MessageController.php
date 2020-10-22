<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = Auth::user();
        $idReceiver = Message::select('receiver_id AS id')
            ->where('sender_id', $user->id)
            ->distinct()
            ->get();

        $idSender = Message::select('sender_id AS id')
            ->where('receiver_id', $user->id)
            ->distinct()
            ->get();

        $ids = $idReceiver->merge($idSender);
        $ids = $ids->toArray();

        $tab = [];
        foreach ($ids as $cle => $valeur) {
            array_push($tab,$valeur);
        }

        $users = User::whereIn('id', $tab)->get();

        $messages = new Collection();

        foreach ($users as $u) {
            $messages->push($this->lastMessage($u->id));
        }

        return view('messages.index', [
            'messages' => $messages->sortByDesc('created_at')
        ]);
    }

    public function lastMessage($id) {
        return Message::where('sender_id', Auth::id())
            ->where('receiver_id', $id)
            ->orWhere('sender_id', $id)
            ->where('receiver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function create(User $user)
    {
        return view('messages.create', [
            'id' => $user->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Application|Factory|View
     */
    public function store(Request $request, User $user)
    {
        if ($request->contenu){
            $message = new Message();
            $message->content = $request->contenu;
            $message->receiver_id = $user->id;
            $message->sender_id = Auth::id();
            $message->save();
        }

        return redirect(route('messages.show', $user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $messages = Message::where('sender_id', Auth::id())
            ->where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->Where('receiver_id', Auth::id())
            ->orderby('created_at')
            ->get();

        return view('messages.show', [
            'messages' => $messages,
            'user' => $user
        ]);

    }

}
