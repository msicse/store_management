<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Employee;
use App\Models\Transection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnExchangeController extends Controller
{
    public function exchange()
    {
        $employees = Employee::where('status', 1)->get();
        $newproducts = Stock::where('is_assigned', 2)->get();
        $oldproducts = Transection::whereNotNull('return_date')->get();
        return view("backend.admin.exchange")->with(compact('newproducts', 'oldproducts', 'employees'));
    }



    public function getproduct($id)
    {
        // $data = Transection::where('employee_id', $id)->get();

        $data = DB::table('stocks')
            ->join('transections', 'stocks.id', '=', 'transections.stock_id')
            ->join('product', 'stocks.id', '=', 'transections.stock_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

    }

    public function exchangePrint()
    {
        return view("backend.admin.exchange");
    }
}
