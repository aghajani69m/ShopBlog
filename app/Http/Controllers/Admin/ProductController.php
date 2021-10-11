<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-products')->only(['index']);
        $this->middleware('can:create-product')->only(['create' , 'store']);
        $this->middleware('can:edit-product')->only(['edit' , 'update']);
        $this->middleware('can:delete-product')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query();

        if($keyword = request('search')) {
            $products->where('title' , 'LIKE' , "%{$keyword}%")->orWhere('id' , 'LIKE' , "%{$keyword}%" );
        }

        $products = $products->latest()->paginate(20);
        return view('admin.products.all' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'inventory' => 'required',
            'categories' => 'required',
            'attributes' => 'array'
        ]);

        $product = auth()->user()->products()->create($validData);
        $product->categories()->sync($validData['categories']);

        if(isset($validData['attributes']))
            $this->attachAttributesToProduct($product, $validData);

        alert()->success('محصول مورد نظر با موفقیت ثبت شد' , 'با تشکر');
        return redirect(route('admin.products.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if ( $this->authorize(['view']) || $this->middleware('can:edit-product')) {

            return view('admin.products.edit', compact('product'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ( $this->authorize(['update']) || $this->middleware('can:edit-product')) {

            $validData = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'inventory' => 'required',
                'image' => 'required',
                'categories' => 'required',
                'attributes' => 'array'
            ]);

//        Storage::disk('public')->putFileAs('files' , $request->file('file') , $request->file('file')->getClientOriginalName());

            $product->update($validData);
            $product->categories()->sync($validData['categories']);

            $product->attributes()->detach();

            if (isset($validData['attributes']))
                $this->attachAttributesToProduct($product, $validData);


            alert()->success('محصول مورد نظر با موفقیت ویرایش شد', 'با تشکر');
            return redirect(route('admin.products.index'));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       if ( $this->authorize(['destroy']) || $this->middleware('can:delete-product')) {
           $product->delete();

           alert()->success('محصول مورد نظر با موفقیت حذف شد', 'با تشکر');
           return back();
       }
       return back();
    }

    /**
     * @param Product $product
     * @param array $validData
     */
    protected function attachAttributesToProduct(Product $product, array $validData): void
    {
        $attributes = collect($validData['attributes']);
        $attributes->each(function ($item) use ($product) {
            if (is_null($item['name']) || is_null($item['value'])) return;

            $attr = Attribute::firstOrCreate(
                ['name' => $item['name']]
            );

            $attr_value = $attr->values()->firstOrCreate(
                ['value' => $item['value']]
            );

            $product->attributes()->attach($attr->id, ['value_id' => $attr_value->id]);
        });
    }

    public function userShow()
    {
        $this->authorize(['view']);
        $user = auth()->user();
        $products = Product::where('user_id',$user->id)->latest()->paginate(20);
        return view('admin.products.user',compact('products'));

    }
}
