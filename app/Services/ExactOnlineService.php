<?php

namespace App\Services;

use App\Models\Exact\SalesInvoice;
use Illuminate\Support\Facades\Log;

class ExactOnlineService
{
    public function sendInvoice(SalesInvoice $invoice): bool
    {
        Log::info('Forwarding Sales Invoice to Exact Online', [
            'InvoiceID' => $invoice->InvoiceID,
            'Journal' => $invoice->Journal,
            'OrderedBy' => $invoice->OrderedBy,
            'SalesInvoiceLines' => $invoice->SalesInvoiceLines
        ]);

        return true;
    }
}