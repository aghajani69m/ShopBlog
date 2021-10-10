<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index',compact('user'));
    }

    public function uploadImage(User $user)
    {
        return view('profile.upload' ,compact('user'));
    }

    public function uploadImagePost(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg|max:2500'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $destinationPath = $destinationPath ."/".$request->user()->file_name;
            $image->move($destinationPath, $name);
        }
        $path = "/images/".$request->user()->file_name."/".$name;


        $request->user()->update([
            'image' => $path,
            ]);
            alert()->success('عکس شما با موفقیت تغییر کرد');
        return redirect('profile');

    }
}
