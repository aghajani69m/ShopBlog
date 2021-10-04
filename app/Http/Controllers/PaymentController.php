<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        $cart = Cart::instance('cart-roocket');
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
                "amount" => 1000 ,
                "payerName" => auth()->user()->name,
                "returnUrl" => route('payment.callback'),
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
//            $order->payments()->create([
//                'resnumber' => $res_number,
//                'price' => $price
//            ]);

            $cart->flush();
            return redirect('/cart');
//            return redirect($payment->getPayUrl());
        }

        // alert()->error();
        return back();
    }

    public function callback()
    {

    }
}
