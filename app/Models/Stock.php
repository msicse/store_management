<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    protected $fillable = [
        'product_id',
        'purchase_id',
        'producttype_id',
        'pproduct_id',
        'serial_no',
        'service_tag',
        'mac',
        'product_status',
        'warranty',
        'purchase_date',
        'expired_date',
        'quantity',
        'assigned',
        'is_assigned'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function producttype()
    {
        return $this->belongsTo(Producttype::class, 'producttype_id');
    }
    public function transections()
    {
        return $this->hasMany(Transection::class, 'stock_id');
    }

}
