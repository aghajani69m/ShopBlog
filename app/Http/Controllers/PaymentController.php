<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $cart = Cart::instance('cart-payment');
        $cartItems = $cart->all();
        if($cartItems->count()) {
            $price = $cartItems->sum(function($cart) {
                return $cart['product']->price * $cart['quantity'];
            });

            $orderItems = $cartItems->mapWithKeys(function($cart) {
                return [$cart['product']->id => [ 'quantity' => $cart['quantity']] ];
            });

            $order = auth()->user()->orders()->create([
                'status' => 'unpaid',
                'price' => $price
            ]);

            $order->products()->attach($orderItems);

            $token = config('services.payping.token');
            $res_number = \Str::random();
            $args = [
                "amount" => $price ,
                "payerName" => auth()->user()->name,
//                "returnUrl" => route('payment.callback'),
                "clientRefId" => $res_number
            ];

//            $payment = new \PayPing\Payment($token);
//
//            try {
//                $payment->pay($args);
//            } catch (\Exception $e) {
//                throw $e;
//            }
//            //echo $payment->getPayUrl();
            $order->payments()->create([
                'resnumber' => $res_number,
                'price' => $price
            ]);
            $request->session()->flash('args' , $args);

            return redirect('payment/callback');
//            return redirect($payment->getPayUrl());
        }

        // alert()->error();
        return back();
    }

    public function callback(Request $request)
    {
        $args = $request->session()->get('args');

        $payment = Payment::where('resnumber', $args['clientRefId'])->firstOrFail();

//        $token = config('services.payping.token');

//        $payping = new \PayPing\Payment($token);

        try {
            // $payment->price
//            if($payping->verify($request->refid, 1000)){
                $payment->update([
                    'status' => 1
                ]);

                $payment->order()->update([
                    'status' => 'paid'
                ]);



                alert()->success('پرداخت شما موفق بود');
            $cart = Cart::instance('cart-payment');

            $cart->flush();

            return redirect('/products');
//            }else{
//                alert()->error('پرداخت شما تایید نشد');
//                return redirect('/products');
//            }
        } catch (\Exception $e) {
            $errors = collect(json_decode($e->getMessage() , true));

            alert()->error($errors->first());
            return redirect('/products');
        }

    }
}
