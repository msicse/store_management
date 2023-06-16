<?php

namespace App\Http\Controllers\Admin;

use Str;
use Toastr;
use Validator;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
         $suppliers = Supplier::all();
         return view('backend.admin.suppliers')->with(compact('suppliers'));
    }
    public function store(Request $request)
    {
        // $this->validate($request,array(
        //     'company'       => 'required|max:255',
        //     'name'          => 'required|max:255',
        //     'phone'         => 'required',
        //     'email'         => 'email',
        //     'address'       => 'required',
        //     'description'   => '',
        // ));

         $validator = Validator::make($request->all(), [
            'company'       => 'required|max:255',
            'name'          => 'required|max:255',
            'phone'         => 'required|unique:suppliers',
            'email'         => 'email|unique:suppliers',
            'address'       => 'required',
            'description'   => '',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        //$slug  = str_slug($request->name);
        $supplier = new Supplier();
        $supplier->company      = $request->company;
        $supplier->name         = $request->name;
        $supplier->phone        = $request->phone;
        $supplier->email        = $request->email;
        $supplier->address      = $request->address;
        $supplier->description  = $request->description;
        $supplier->save();

        // Toastr::success(' Succesfully Saved ', 'Success');
        // return redirect()->back();
        return response()->json(['success'=>'Data is successfully added']);
        
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return $supplier;   
    }

    public function unique(Request $request)
    {
        $supplier = Supplier::where('email', $request->email)->exists();
        return $supplier;

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,array(
            'company'       => 'required|max:255',
            'name'          => 'required|max:255',
            'phone'         => 'required|unique:suppliers',
            'email'         => 'email|unique:suppliers',
            'address'       => 'required',
            'description'   => '',
        ));
        //$slug  = str_slug($request->name);

        $purchases = Purchase::where('supplier_id', '=', $id )->exists();
        
        if ($purchases) {
            Toastr::error(' Update Restricted ', 'Error');
        } else {
            $supplier = Supplier::find($id);
            $supplier->company      = $request->company;
            $supplier->name         = $request->name;
            $supplier->phone        = $request->phone;
            $supplier->email        = $request->email;
            $supplier->address      = $request->address;
            $supplier->description  = $request->description;
            $supplier->save();
            Toastr::success(' Succesfully Updated ', 'Success');
        }

        
        return redirect()->back();
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);


        $purchases = Purchase::where('supplier_id', '=', $id )->exists();
        
        if ($purchases) {
            Toastr::error(' Delete Restricted ', 'Error');
        } else {
            $supplier->delete();
            Toastr::success('Succesfully Deleted ', 'Success');
        }
        
        return redirect()->back();
    }
}
