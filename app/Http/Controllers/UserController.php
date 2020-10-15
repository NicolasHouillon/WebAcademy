<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PaypalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Inline\Element\Image;

class UserController extends Controller
{

    private PaypalService $paypalService;

    /**
     * UserController constructor.
     * @param PaypalService $service
     */
    public function __construct(PaypalService $service)
    {
        $this->middleware(['auth']);
        $this->paypalService = $service;
    }

    public function show(string $name)
    {
        $this->authorize('viewAny', User::class);
        if (Auth::user()->slugFullName() == $name) {
            $user = Auth::user();
        } else {
            $data = explode("_", $name);
            $user = User::where([
                'firstname' => $data[0],
                'lastname' => $data[1]
            ])->first();
        }

        $return = [
            'user' => $user,
            'sended_messages' => $user->sendedMessages(),
            'reveived_messages' => $user->reveivedMessages(),
            'children' => User::getStudents()
        ];

        if (Auth::check() && $user->group_id == 2) {
            $return['mesCours'] = $user->courses;
        }

        $return['orders'] = collect(Auth::user()->orders)->map(function ($order) {
            return [
                'order' => $order,
                'details' => $this->paypalService->getOrderDetails($order->paypal_order_id)->result
            ];
        });

        return view('users.show', $return);
    }

    public function edit(string $name)
    {
        $user = User::getUserForSlug($name);
        $this->authorize('update', $user);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, string $name)
    {
        $user = User::getUserForSlug($name);
        $this->authorize('update', $user);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->save();

        return redirect()->route('user_profile', $user->slugFullName());
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $this->authorize('delete', $user);
        if ($request->delete == 'valide') {
            $user->delete();
            return redirect()->route('index');
        }
        return redirect()->route('user_profile', $user->slugFullName());

    }

    public function uploadImage(Request $request) {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $user = Auth::user();
        if ($request->hasFile('avatar')){
            $img = $request->file('avatar');
            $extension = $img->getClientOriginalExtension();
            Storage::disk('public')->put("avatar/".$user->id."/".$img->getFilename().'.'.$extension,  File::get($img));
            $user->avatar = "storage/avatar/".$user->id."/".$img->getFilename().'.'.$extension;
            $user->save();
        }

        return redirect()->route('user_profile', $user->slugFullName());
    }


    public function listOfProf() {
        return view('users.prof', [
            'profs' => User::all()->where('group_id', '=',2)
        ]);
    }
}
