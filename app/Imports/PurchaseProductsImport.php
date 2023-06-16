<?php

namespace App\Imports;

use App\Models\PurchaseProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchaseProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PurchaseProduct([
            'purchase_id'       => $row['purchase_id'],
            'product_id'        => $row['product_id'],
            'supplier_id'       => $row['supplier_id'],
            'quantity'          => $row['quantity'],
            'unit_price'        => $row['unit_price'],
            'total_price'       => $row['total_price'],
            'serials'           => $row['serials'],
            'warranty'          => $row['warranty'],
            'purchase_date'     => $row['purchase_date'],
            'expired_date'      => $row['expired_date'],
            'is_stocked'        => $row['is_stocked']
        ]);
    }
}
