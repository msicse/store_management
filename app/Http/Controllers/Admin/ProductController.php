<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Producttype;
use App\Models\Purchase;
use Toastr;
use Str;

class ProductController extends Controller
{
    public function index()
    {
         $types = Producttype::all();
         $products = Product::all();
         return view('backend.admin.products')->with(compact('products','types'));
    }
    public function store(Request $request)
    {
        $this->validate($request,array(
            'title' => 'required|max:255',
            'brand' => 'required|max:255',
            'type' => 'required|numeric',
            'model' => 'required|max:255',
            'unit' => 'required|alpha|max:255',
            'serial' => 'sometimes|numeric|max:1',
            'license' => 'sometimes|numeric|max:1',
            'description' => 'required|max:255',
        ));
        //$slug  = str_slug($request->name);
        // return $request->all();
        $product = new Product();
        $product->title             = $request->title;
        $product->producttype_id    = $request->type;
        $product->model             = $request->model;
        $product->brand             = $request->brand;
        $product->unit              = $request->unit;
        $product->is_license        = $request->license;
        $product->is_serial         = $request->serial;
        $product->description       = $request->description;
        // $product->description       = $request->title." ". $request->brand." ". $request->model." ".$request->description;
        $product->slug              = Str::slug($request->title);
        $product->save();

        Toastr::success(' Succesfully Saved ', 'Success');
        return redirect()->back();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return $product;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,array(
            'title' => 'required|max:255',
            'brand' => 'required|max:255',
            'type' => 'required|numeric',
            'model' => 'required|max:255',
            'unit' => 'required|alpha|max:255',
            'serial' => 'sometimes|numeric|max:1',
            'license' => 'sometimes|numeric|max:1',
            'description' => 'required|max:255',
        ));


        $products = false;//Purchase::where('product_id', '=', $id )->exists();

        if ($products) {
            Toastr::error(' Update Restricted ', 'Error');
        } else {
            //$slug  = str_slug($request->name);
            $product = Product::find($id);
            $product->title             = $request->title;
            $product->producttype_id    = $request->type;
            $product->model             = $request->model;
            $product->brand             = $request->brand;
            $product->unit              = $request->unit;
            $product->is_license        = $request->license;
            $product->is_serial         = $request->serial;
            $product->description       = $request->description;
            $product->save();

            Toastr::success(' Succesfully Updated ', 'Success');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        $products =NULL;// Purchase::where('product_id', '=', $id )->exists();

        if ($products) {
            Toastr::error(' Delete Restricted ', 'Error');
        } else {
            $product->delete();
            Toastr::success('Succesfully Deleted ', 'Success');
        }

        return redirect()->back();
    }
}
