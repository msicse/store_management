<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::orderBy('emply_id', 'asc')->get();
        $departments = Department::all();
       

        if(isset($request->department_id)){
            $employees = Employee::where('department_id', $request->department_id)
                                ->orderBy('emply_id', $request->order_by )
                                ->get();
        }

        return view('backend.report.index')->with(compact('employees', 'departments'));
    }
}
