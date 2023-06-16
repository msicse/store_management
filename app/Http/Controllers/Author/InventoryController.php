<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Stock;
use Toastr;


class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Stock::all();
        return view('backend.author.inventory.index')->with(compact('inventories'));
    }

    public function show($id)
    {
        $stock = Stock::find($id);
        //dd($stock);
        return view('backend.author.inventory.show')->with(compact('stock'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            // 'mac'           => 'required',
            'service_tag'     => 'required',
            
        ));

        $inventory = Stock::find($id);
        $inventory->mac = $request->mac;
        $inventory->service_tag = $request->service_tag;
        $inventory->save();

        Toastr::success(' Inventory Updated  ', 'Success');
        return redirect()->back();
    }

}
