<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use Toastr;
use Str;


class DepartmentController extends Controller
{
    public function index()
    {
         $departments = Department::all();
         return view('backend.author.departments')->with(compact('departments'));
    }
    public function store(Request $request)
    {
        $this->validate($request,array(
            'name'          => 'required|max:255',
            'short_name'    => 'required|max:255',
        ));

        $slug  = Str::slug($request->name);
        $department = new Department();
        $department->name         = $request->name;
        $department->short_name   = $request->short_name;
        $department->slug        = $slug;
        $department->save();

        Toastr::success(' Succesfully Saved ', 'Success');
        return redirect()->back();
    }
}
