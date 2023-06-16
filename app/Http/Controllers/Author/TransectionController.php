<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transection;
use App\Models\Employee;
use App\Models\Stock;
use Toastr;

class TransectionController extends Controller
{
    public function index()
    {
        $transections = Transection::all();
        return view('backend.author.transection.index')->with(compact('transections'));
    }

    public function create()
    {
        $stoks = Stock::where('product_status', 1)->where('is_assigned', 2)->whereNotNull('service_tag')->get();
        $employees = Employee::all();
        return view('backend.author.transection.create')->with(compact('stoks', 'employees'));
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'product'           => 'required|integer',
            'employee'          => 'required|integer',
            //'quantity'          => 'required|integer',
            'date_of_issue'     => 'required',
            
        ));
        
        $transection = new Transection();
        $transection->stock_id     = $request->product;
        $transection->employee_id  = $request->employee;
        $transection->quantity     = 1;
        $transection->issued_date  = $request->date_of_issue;
        $transection->mouse     = $request->mouse;
        $transection->pendrive     = $request->pendrive;
        $transection->bag     = $request->laptop_bag;
        $transection->comment     = $request->comment;
        $transection->save();

        Stock::where('id',$transection->stock_id)->update(['is_assigned'=> 1]);


        Toastr::success(' Succesfully Saved ', 'Success');
        return redirect()->route('author.transections.index');

        $transections = Transection::all();
        return view('backend.author.transection.create')->with(compact('transections'));
    }

    public function show($id)
    {
        $transection = Transection::find($id);
        return view('backend.author.transection.show')->with(compact('transection'));
    }
}
