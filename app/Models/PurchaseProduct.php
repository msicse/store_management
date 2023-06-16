<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;

    protected $fillable = [
            'purchase_id',
            'product_id',
            'supplier_id',
            'quantity',
            'unit_price',
            'total_price',
            'serials',
            'warranty',
            'purchase_date',
            'expired_date',
            'is_stocked'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
}
