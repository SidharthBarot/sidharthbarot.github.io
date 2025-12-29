<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
class PaymentController extends Controller
{
    //
    

//     $api = new Api(
//     config('services.razorpay.key'),
//     config('services.razorpay.secret')
// );
public function showPayPage()
    {
        return view('user.pay');
    }

    public function createOrder(Request $request)
    {
        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $order = $api->order->create([
            'amount' => 500 * 100,
            'currency' => 'INR',
            'receipt' => uniqid()
        ]);

        Payment::create([
            'user_id' => auth()->id(),
            'razorpay_order_id' => $order['id'],
            'amount' => 500,
            'status' => 'created'
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'key' => config('services.razorpay.key')
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        Payment::where('razorpay_order_id', $request->razorpay_order_id)
            ->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'status' => 'paid'
            ]);

        return redirect()->back()->with('success', 'Payment Successful');
    }


}
