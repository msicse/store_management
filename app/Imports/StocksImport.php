<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

// class UsersImport implements ToModel, WithHeadingRow
class StocksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // dd ($row);

        // return new Stock($row);

        return new Stock([
            'product_id'        => $row['product_id'],
            'purchase_id'       => $row['purchase_id'],
            'producttype_id'    => $row['producttype_id'],
            'pproduct_id'       => $row['pproduct_id'],
            'serial_no'         => $row['serial_no'],
            'service_tag'       => $row['service_tag'],
            'mac'               => $row['mac'],
            'product_status'    => $row['product_status'],
            'warranty'          => $row['warranty'],
            'purchase_date'     => $row['purchase_date'],
            'expired_date'      => $row['expired_date'],
            'quantity'          => $row['quantity'],
            'assigned'          => $row['assigned'],
            'is_assigned'       => $row['is_assigned'],
        ]);
    }
}
