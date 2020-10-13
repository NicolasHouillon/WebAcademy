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
            'messages' => $messages
        ]);
    }

    public function lastMessage($id) {
        return Message::where('sender_id', Auth::id())
            ->where('receiver_id', $id)
            ->orWhere('sender_id', $id)
            ->Where('receiver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->orderBy('created_at','asc')
            ->limit(1)
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($id)
    {
        return view('messages.create', [
            'id' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|Factory|View
     */
    public function store(Request $request,$id)
    {
        $message = new Message();
        $message->content = $request->contenu;
        $message->receiver_id = $id;
        $message->sender_id = Auth::id();

        $message->save();

        return redirect(route('messages.show',$id));
    }

    /**
     * Display the specified resource.
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $user = Auth::user();
        $messages = Message::where('sender_id', $user->id)
            ->where('receiver_id', $id)
            ->orWhere('sender_id', $id)
            ->Where('receiver_id', $user->id)
            ->orderBy('created_at', 'desc');

        return view('messages.show', [
            'messages' => $messages->get()
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
