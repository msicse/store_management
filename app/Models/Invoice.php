<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{   
    
    use HasFactory;
    
    protected $casts = [
        'date' => 'date',
    ];
    
    protected static function booted()
    {
        static::created(function ($invoice) {
            $invoice->number = $invoice->generateNumber();
            $invoice->save();
        });
    }
    
    public function generateNumber()
    {
        return vsprintf('R%s/%s-%05d', [
            $this->date->format('Y'),
            $this->date->addYear()->format('Y'),
            self::whereBetween('date', [
                $this->date->startOfYear(),
                $this->date->endOfYear()
            ])->count() + 1,
        ]);
    }
}
