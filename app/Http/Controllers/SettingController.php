<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Transection;
use Auth;
use Toastr;
use Str;
use Image;

class SettingController extends Controller
{
    public function profile(Request $request)
    {
        
        
        if ($request->method() == "POST"){

            //return $request->all();
            
            $this->validate($request, array(
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                'about' => 'required',
            ));

            $user = User::where('id', Auth::user()->id)->first();

            $slug  = Str::slug(Auth::user()->username);
    
            if($request->hasFile('image')) {

                $image       = $request->file('image');
                $filename    = $slug . "-". time().'.'.$image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(800, 800);
                $image_resize->save('images/users/' .$filename);

                if ($user->image != 'avater.png') {
                    if( file_exists('images/users/' .$user->image) ){
                        unlink('images/users/' .$user->image);
                    }
                }

            }else {
                $filename = Auth::user()->image;
            }

            $user->name     = $request->name;
            $user->phone     = $request->phone;
            $user->about     = $request->about;
            $user->image     = $filename;
            $user->save();

            Toastr::success(' Succesfully Updated ', 'Success');
            return redirect()->back();



        } else {
            return view('backend.settings.profile');

        }


    }


    public function password(Request $request)
    {
        
        
        if ($request->method() == "POST"){

            $this->validate($request, array(
                'current_password'  => 'required|min:6',
                'new_password'          => 'required|min:6',
                'confirm_password'  => 'required|same:new_password|min:6',
            ));
    
                if (Hash::check($request->current_password, Auth::user()->password)) {
                    $user = Auth::user();
                    $user->password     = Hash::make($request->new_password);
                    $user->save();
                    Toastr::success(' Succesfully Updated ', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error(' Current Password not Match ', 'Error');
                    return redirect()->back();
                }
        } else {
            return view('backend.settings.password');

        }


    }
    
    public function policy($id)
    {
        
        $data = Transection::find($id);
        return view('backend.settings.policy')->with(compact('data'));

        
    }
}
