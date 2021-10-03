<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-categories')->only(['index']);
        $this->middleware('can:create-category')->only(['create' , 'store']);
        $this->middleware('can:edit-category')->only(['edit' , 'update']);
        $this->middleware('can:delete-category')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query();

        if($keyword = request('search')) {
            $categories->where('name' , 'LIKE' , "%{$keyword}%")->orWhere('id' , $keyword);
        }

        $categories = Category::where('parent' , 0)->latest()->paginate(10);
        return view('admin.categories.all' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->parent) {
            $request->validate([
                'parent' => 'exists:categories,id'
            ]);
        }

        $request->validate([
            'name' => 'required|min:3'
        ]);

        Category::create([
            'name' => $request->name,
            'parent' => $request->parent ?? 0
        ]);

        alert()->success('دسته مورد نظر ثبت شد');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if($request->parent) {
            $request->validate([
                'parent' => 'exists:categories,id'
            ]);
        }

        $request->validate([
            'name' => 'required|min:3'
        ]);

        $category->update([
            'name' => $request->name,
            'parent' => $request->parent
        ]);

        alert()->success('دسته مورد نظر ویرایش شد');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();

        alert()->success('دسته مورد نظر حذف شد');
        return back();
    }
}
