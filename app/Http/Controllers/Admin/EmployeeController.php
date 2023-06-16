<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Transection;
use Image;
use Toastr;
use Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('backend.admin.employee.index')->with(compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('backend.admin.employee.create')->with(compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, array(
            'department'    => 'required|integer',
            'name'          => 'required|max:255',
            'designation'   => 'required|max:255',
            'date_of_join'  => '',
            'phone'         => '',
            'email'         => '',
            'about'         => '',
            'employee_id'   => 'required',
            'image'         => 'image',
        ));

        
        //return $request->all();
        $slug = Str::slug($request->name);

        if($request->hasFile('image')) {

            $image       = $request->file('image');
            $filename    = $slug . "-". time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());              
            //$image_resize->resize(400, 400);
            $image_resize->save('images/employee/' .$filename);
        }else{
            $filename = 'no-image.png';
        }

        $employee = new Employee();

        $employee->name     = $request->name;
        $employee->department_id     = $request->department;
        $employee->designation     = $request->designation;
        $employee->emply_id     = $request->employee_id;
        $employee->date_of_join     = $request->date_of_join;
        $employee->phone     = $request->phone;
        $employee->status     = 1;
        $employee->email     = $request->email;
        $employee->about     = $request->about;
        $employee->image     = $filename;
        $employee->save();

        Toastr::success(' Succesfully Saved ', 'Success');
        return redirect()->route('admin.employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('backend.admin.employee.show')->with(compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $employee = Employee::find($id);
        return view('backend.admin.employee.edit')->with(compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'department'    => 'required|integer',
            'name'          => 'required|max:255',
            'designation'   => 'required|max:255',
            'date_of_join'  => '',
            'date_of_resign'  => '',
            'phone'         => '',
            'email'         => '',
            'about'         => '',
            'image'         => 'image',
        ));
    

        // $transections = Transection::where('employee_id', '=', $id )->exists();

        // if( $transections ) {
        //     Toastr::error('Update Resticted  ', 'Error');
        // } else {
        
            
            $employee = Employee::find($id);
            $slug = Str::slug($request->name);

            if($request->hasFile('image')) {
   
            $image       = $request->file('image');
            $filename    = $slug . "-". time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(800, 800);
            $image_resize->save('images/employee/' .$filename);
                
                if( file_exists('images/employee/' .$employee->image) ){
                    unlink('images/employee/' .$employee->image);
                }
                
            }else{
                $filename = $employee->image;
            }


            

            $employee->name             = $request->name;
            $employee->department_id    = $request->department;
            $employee->designation      = $request->designation;
            $employee->date_of_join     = $request->date_of_join;
            $employee->resign_date      = $request->date_of_resign;
            $employee->phone            = $request->phone;
            $employee->status           = 1;
            $employee->email            = $request->email;
            $employee->about            = $request->about;
            $employee->image            = $filename;
            $employee->save();

            Toastr::success(' Succesfully Saved ', 'Success');
        // }

        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $employee = Employee::find($id);

        if($employee->status == 1){
            $employee->status = 2;
        } else {
            $employee->status = 1;
        }

        $employee->save();
        Toastr::success(' Status Updated ', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
