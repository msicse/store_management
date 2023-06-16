<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Stock;
use Toastr;
use Validator;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Stock::all();
        return view('backend.admin.inventory.index')->with(compact('inventories'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('backend.admin.purchase.create')->with(compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request, array(
            'product'           => 'required|integer',
            'supplier'          => 'required|integer',
            'unit_price'        => 'required',
            'quantity'          => 'required|integer',
            'date_of_purchase'  => 'required',
            
        ));

        $total = $request->quantity * $request->unit_price;
        $purchase = new Purchase();

        $purchase->product_id   = $request->product;
        $purchase->supplier_id   = $request->supplier;
        $purchase->unite_price   = $request->unit_price;
        $purchase->quantity   = $request->quantity;
        $purchase->total_price   = $total;
        $purchase->purchase_date   = $request->date_of_purchase;
        $purchase->save();//   = $request->date_of_purchase;

        Toastr::success(' Succesfully Saved ', 'Success');
        return redirect()->route('admin.purchases.index');

    }
    public function show($id)
    {
        $stock = Stock::find($id);
        //dd($stock);
        return view('backend.admin.inventory.show')->with(compact('stock'));
    }
    
    public function update(Request $request, $id)
    {
       $rules = [
            'service_tag' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'   => 'Service Tag is required',
            ]);
        }
        

        $inventory = Stock::find($id);
        $inventory->mac = $request->mac;
        $inventory->service_tag = $request->service_tag;
        $inventory->save();

        return response()->json([
            'message' => 'Inventory Updated',
            'status' => 200,
        ]);
    }


}
