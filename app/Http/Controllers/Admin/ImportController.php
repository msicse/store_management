<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Imports\PurchasesImport;
use App\Imports\PurchaseProductsImport;
use App\Imports\StocksImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function getStock()
    {
        return view('backend.admin.imports.stocks');
    }

    public function stockStore(Request $request)
    {

        // return $request->all();
        Excel::import(new PurchaseProductsImport, $request->file('stocks'));
        // Excel::import(new StocksImport, $request->file('stocks'));
        return "Successfully uploaded";
    }
}
