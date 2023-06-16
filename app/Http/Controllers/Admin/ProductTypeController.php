<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producttype;
use Toastr;
use Str;

class ProductTypeController extends Controller
{
    public function index()
    {
        $types = Producttype::latest()->get();
        return view('backend.admin.product-type')->with(compact('types'));
    }
    public function store(Request $request)
    {
        $this->validate($request,array(
            'name' => 'required|max:255|unique:producttypes'
        ));
        //$slug  = str_slug($request->name);
        $type = new Producttype();
        $type->name = $request->name;
        $type->slug = Str::slug($request->name);
        $type->save();
        Toastr::success(' Succesfully Saved ', 'Success');
        return redirect()->back();
    }

    public function edit($id)
    {
        $type = Producttype::find($id);
        return $type;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,array(
            'name' => 'required|max:255|unique:producttypes'
        ));

        //$slug  = str_slug($request->name);
        $type = Producttype::find($id);
        $type->name = $request->name;
        $type->slug = Str::slug($request->name);
        $type->save();

        Toastr::success(' Succesfully Saved ', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $role = Producttype::find($id);
        $role->delete();
        Toastr::success('Succesfully Deleted ', 'Success');
        return redirect()->back();
    }
}
