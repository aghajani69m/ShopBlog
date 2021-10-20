<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('home.products', compact('products'));
    }

    public function singleView(Product $product)
    {
        $product->update([
            'view_count' => $product->view_count + 1
        ]);
        return view('home.single-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if ($this->authorize('update', $product))

            return view('products.edit', compact('product'));

        return abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($this->authorize('update', $product)) {

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
        return abort(401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($this->authorize('destroy', $product)) {
            $product->delete();

            alert()->success('محصول مورد نظر با موفقیت حذف شد', 'با تشکر');
            return back();
        }
        return abort(401);
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


}
