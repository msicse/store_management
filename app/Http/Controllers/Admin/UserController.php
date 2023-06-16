<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Toastr;
use Str;
use Hash;
use Image;
class UserController extends Controller
{
    public function index()
    {
         $users = User::latest()->get();
         return view('backend.admin.user.users')->with(compact('users'));
    }
    public function create()
    {
         $users = User::latest()->get();
         $roles = Role::All();
         return view('backend.admin.user.create')->with(compact('users','roles'));
    }
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,array(
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'role' => 'required|max:255',
            'password' => 'required|max:255',
            'about' => 'required',
        ));


        $slug  = Str::slug($request->username);
        $user = new User();

        if($request->hasFile('image')) {

            $image       = $request->file('image');
            $filename    = $slug . "-". time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(800, 800);
            $image_resize->save('images/users/' .$filename);
        }else {
            $filename = 'avater.png';
        }


        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->about = $request->about;
        $user->image = $filename;
        $user->password = Hash::make($request->password);
        $user->save();
        Toastr::success('User Succesfully Saved ', 'Success');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->image != 'avater.png') {
            if( file_exists('images/users/' .$user->image) ){
                unlink('images/users/' .$user->image);
            }
        }
        
        $user->delete();

        Toastr::success('User Succesfully Deleted ', 'Success');
        return redirect()->back();
    }
}
