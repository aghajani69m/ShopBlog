<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-users')->only(['index']);
        $this->middleware('can:create-user')->only(['create' , 'store']);
        $this->middleware('can:edit-user')->only(['edit' , 'update']);
        $this->middleware('can:delete-user')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query();

        if($keyword = request('search')) {
            $users->where('email' , 'LIKE' , "%{$keyword}%")->orWhere('name' , 'LIKE' , "%{$keyword}%" )->orWhere('id' , $keyword);
        }

        if (\request('admin')) {
            $this->authorize('show-staff-users');
            $users->where('is_superuser', 1)->orWhere('is_staff', 1)
                ->orWhere('is_superadmin', 1)->orWhere('is_admin', 1);
        }

        if (Gate::allows('show-staff-users')) {
            if (\request('admin')) {
                $users->where('is_superuser', 1)->orWhere('is_staff', 1)
                    ->orWhere('is_superadmin', 1)->orWhere('is_admin', 1);
            }
        } else {
            $users->where('is_superuser', 0)->orWhere('is_staff', 0)
                ->orWhere('is_superadmin', 0)->orWhere('is_admin', 0);
        }

        $users = $users->latest()->paginate(20);
        return view('admin.users.all' , compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $filename = $data['name'] . rand(1000,9999);

        $data['file_name'] = $filename;

        File::makeDirectory(public_path().'/images/users/'.$filename);

        $user = User::create($data);

        if( $request->is_admin == 'on') {
            $data['is_admin'] = true ;
            $user->roles()->attach([
                $user->id => '1',
            ]);

        }else{
            $data['is_admin'] = false ;
        }
        if( $request->is_staff == 'on') {
            $data['is_staff'] = true ;
            $user->roles()->attach([
                $user->id => '2',
            ]);
        }else{
            $data['is_staff'] = false ;
        }
        if( $request->is_superuser == 'on') {
            $data['is_superuser'] = true ;
            $user->roles()->attach([
                $user->id => '3',
            ]);
        }else{
            $data['is_superuser'] = false ;
        }


        if($request->has('verify')) {
            $user->markEmailAsVerified();
        }
        alert()->success('کاربر مورد نظر شما با موفقیت ثبت شد');
        return redirect(route('admin.users.index'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return User
     */
    public function edit(User $user)
    {
        return view('admin.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:200', Rule::unique('users')->ignore($user->id)],
        ]);

        if(! is_null($request->password)) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $data['password'] = $request->password;
        }

        if( $request->is_admin == 'on') {
            $data['is_admin'] = true ;
            $user->roles()->sync([
                $user->id => '1',
            ]);
        }else{
            $data['is_admin'] = false ;
            $user->roles()->detach([
                $user->id => '1',
            ]);
        }
        if($request->is_staff == 'on') {
            $data['is_staff'] = true ;
            $user->roles()->sync([
                $user->id => '2',
            ]);
        }else{
            $data['is_staff'] = false ;
            $user->roles()->detach([
                $user->id => '2',
            ]);
        }
        if( $request->is_superuser == 'on') {
            $data['is_superuser'] = true ;
            $user->roles()->sync([
                $user->id => '3',
            ]);
        }else{
            $data['is_superuser'] = false ;
            $user->roles()->detach([
                $user->id => '3',
            ]);
        }
        $user->update($data);

        if($request->has('verify')) {
            $user->markEmailAsVerified();
        }

        alert()->success('کاربر مورد نظر شما با موفقیت ویرایش شد');
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('کاربر مورد نظر شما با موفقیت حذف شد');
        return back();
    }
}
