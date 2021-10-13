<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('home.products' , compact('products'));
    }

    public function single(Product $product)
    {
        $product->update([
            'view_count' => $product->view_count + 1
        ]);
        return view('home.single-product' , compact('product'));
    }
}
