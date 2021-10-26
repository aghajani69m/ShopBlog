<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $cart = Cart::instance();
        $cartItems = $cart->all();
        if($cartItems->count()) {
            $price = $cartItems->sum(function($cart) {
                return $cart['discount_percent'] == 0
                    ? $cart['product']->price * $cart['quantity']
                    : ($cart['product']->price - ($cart['product']->price * $cart['discount_percent'])) * $cart['quantity'];
            });

            $orderItems = $cartItems->mapWithKeys(function($cart) {
                return [$cart['product']->id => [ 'quantity' => $cart['quantity'] , 'price' => $cart['product']->price] ];
            });

            $order = auth()->user()->orders()->create([
                'status' => 'unpaid',
                'price' => $price
            ]);

            $order->products()->attach($orderItems);

//            $token = config('services.payping.token');
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
            ]);
            $request->session()->flash('args' , $args);
//            $cart->flush();
            return redirect('payment/callback/confirm');
//            return redirect($payment->getPayUrl());
        }

        // alert()->error();
        return back();
    }

    public function callbackConfirm(Request $request)
    {
        $request->session()->reflash();
        return view('home.payment-confirm');

    }

    public function callback(Request $request)
    {
        if ($request->confirm === "true") {
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
                $cart = Cart::instance();

                foreach($cart->all()->toArray() as $item)
                $product = $item['product'];
                $product->update([
                    'inventory' => $product->inventory - $item['quantity'],
                ]);

                $cart->flush();

                return redirect('/products');
            } catch (\Exception $e) {

                $errors = collect(json_decode($e->getMessage(), true));

                alert()->error($errors->first());
                return redirect('/products');
            }

        }
        if ($request->confirm === "false") {
            $args = $request->session()->get('args');

            $payment = Payment::where('resnumber', $args['clientRefId'])->firstOrFail();
//        $token = config('services.payping.token');

//        $payping = new \PayPing\Payment($token);

            try {
                // $payment->price
//            if($payping->verify($request->refid, 1000)){
                $payment->update([
                    'status' => 0
                ]);

                $payment->order()->update([
                    'status' => 'unpaid'
                ]);


                alert()->error('پرداخت شما موفق نبود');
                $cart = Cart::instance();

                $cart->flush();

                return redirect('/products');
            } catch (\Exception $e) {

                $errors = collect(json_decode($e->getMessage(), true));

                alert()->error($errors->first());
                return redirect('/products');
            }

        }
    }


}
