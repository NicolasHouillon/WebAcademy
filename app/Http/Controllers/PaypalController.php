<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use App\Services\PaypalService;
use Illuminate\Support\Facades\Auth;

class PaypalController extends Controller
{

    private PaypalService $service;

    /**
     * PaypalController constructor.
     * @param PaypalService $service
     */
    public function __construct(PaypalService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }


    public function paymentHandle(Course $course)
    {
        $find = Order::where([
            'user_id' => Auth::id(),
            'course_id' => $course->id
        ])->get();

        if ($find) {
            return back()->withErrors('Vous avez déjà acheté ce cours.');
        }
        $response = $this->service->createOrder($course);
        $id = $response->result->id;

        $order = new Order;
        $order->user_id = Auth::id();
        $order->course_id = $course->id;
        $order->paypal_order_id = $id;
        $order->save();

        return redirect($response->result->links[1]->href);
    }

    public function paymentCancel()
    {

    }

    public function paymentSuccess()
    {
        return redirect()->route('courses.index')->with('success', 'Le paiment a été pris en compte.');
    }

}
