<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        Invoice::create([
            'date' => $request->date('date'),
        ]);
    }
}
