<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exact\SalesInvoice;

class SalesInvoiceController extends Controller
{
    public function store(Request $request)
    {
        //Validate the sales invoice
        $validated = $request->validate([
            'InvoiceID' => 'required|uuid',
            'Journal' => 'required|string',
            'OrderedBy' => 'required|uuid',
            'SalesInvoiceLines' => 'required|array',
            'SalesInvoiceLines.*.GLAccount' => 'required|uuid',
            'SalesInvoiceLines.*.InvoiceID' => 'required|uuid',
            'SalesInvoiceLines.*.Item' => 'required|uuid'
        ]);

        $invoice = SalesInvoice::create([
            'InvoiceID' => $validated['InvoiceID'],
            'Journal' => $validated['Journal'],
            'OrderedBy' => $validated['OrderedBy'],
        ]);

        foreach ($validated['SalesInvoiceLines'] as $line) {
            $invoice->SalesInvoiceLines()->create([
                'InvoiceID' => $invoice->InvoiceID,
                'GLAccount' => $line['GLAccount'],
                'Item' => $line['Item'],
            ]);
        }

        return response()->json($invoice, 201);
    }
}