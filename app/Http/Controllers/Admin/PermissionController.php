<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::query();

        if($keyword = request('search')) {
            $permissions->where('label' , 'LIKE' , "%{$keyword}%")->orWhere('name' , 'LIKE' , "%{$keyword}%" )->orWhere('id' , $keyword);
        }


        $permissions = $permissions->latest()->paginate(20);
        return view('admin.permissions.all' , compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50','unique:permissions'],
            'label' => ['required', 'string', 'max:255'],
        ]);

        Permission::create($data);

        alert()->success('دسترسی مورد نظر شما با موفقیت ثبت شد');

        return redirect(route('admin.permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit' , compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('permissions')->ignore($permission->id)],
            'label' => ['required', 'string', 'max:255'],
        ]);


        $permission->update($data);


        alert()->success('دسترسی مورد نظر شما با موفقیت ویرایش شد');

        return redirect(route('admin.permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        alert()->success('دسترسی مورد نظر شما با موفقیت حذف شد');
        return back();
    }
}
