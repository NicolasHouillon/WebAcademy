<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PaypalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'reveived_messages' => $user->reveivedMessages()
        ];

        if (Auth::check() && $user->group_id == 2) {
            $return['mesCours'] = $user->courses;
        }

        if (Auth::check() && $user->group_id == 4) {
            $return['coursSuivis'] = $user->followed;
        }

        $return['orders'] = collect(Auth::user()->orders)->map(function ($order) {
            return [
                'order' => $order,
                'details' => $this->paypalService->getOrderDetails($order->paypal_order_id)->result
            ];
        });

        return view('users.show', $return);
    }

    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $input = $request->only(['lastename','firstname','email' ,'password', 'avatar']);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->avatar = $request->avatar;

        $user->save();

        return redirect()->route('user_profile', $user->slugFullName());
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->delete == 'valide') {
            $user->delete();
            return redirect()->route('index');
        }
        return redirect()->route('user_profile', $user->slugFullName());

    }

}
