<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function catPro(Category $category)
    {
        $cart = \App\Helpers\Cart\Cart::instance();
        $products = $category->products;

        return view('cat',compact('cart' , 'products','category'));

    }

    public function specials()
    {
        $cart = Cart::instance();
        $discounts = Discount::all();
//        dd($discounts);
        foreach ($discounts as $discount) {

            if ($discount->users()->count() == 0) ;
            {
            $products = $discount->products()->get();
            $disco = $discount;
            }
        }
        if(!isset($products))
            $products = null;
//            dd($products);

        return view('specials',compact('products','cart'));
    }

    public function comment(Request $request)
    {

//        if(! $request->ajax()) {
//            return response()->json([
//                'status' => 'just ajax request'
//            ]);
        $validData = $request->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'parent_id' => 'required',
            'comment' => 'required'
        ]);

        auth()->user()->comments()->create($validData);
//
//        return response()->json([
//           'status' => 'success'
//        ]);
        alert()->success('نظر با موفقیت ثبت شد');
        return back();
    }
}
