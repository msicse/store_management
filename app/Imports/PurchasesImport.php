<?php

namespace App\Imports;

use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchasesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Purchase([
            'supplier_id'       => $row['supplier_id'],
            'total_price'       => $row['total_price'],
            'reference_invoice' => $row['reference_invoice'],
            'challan_no'        => $row['challan_no'],
            'purchase_date'     => $row['purchase_date'],
            'is_stocked'        => $row['is_stocked']
        ]);
    }
}
