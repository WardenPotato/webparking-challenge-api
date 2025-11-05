<?php

namespace App\Models\Exact;

use Illuminate\Database\Eloquent\Model;

class SalesInvoiceLine extends Model
{
    protected $fillable = [
        'GLAccount',
        'InvoiceID',
        'Item'
    ];

    public function SalesInvoice()
    {
        return $this->belongsTo(SalesInvoice::class, 'InvoiceID', 'InvoiceID');
    }
}
