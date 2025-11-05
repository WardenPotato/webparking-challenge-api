<?php

namespace App\Models\Exact;

/**
 * Class SalesInvoice.
 *
 * @see https://start.exactonline.nl/docs/HlpRestAPIResourcesDetails.aspx?name=SalesInvoiceSalesInvoices
 *
 * @property string $InvoiceID Primary key
 * @property string $Journal The journal code. Every invoice should be linked to a sales journal
 * @property string $OrderedBy Customer who ordered the invoice
 * @property SalesInvoiceLine[] $SalesInvoiceLines Collection of lines
 * 
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesInvoice extends Model
{
    // protected $primaryKey = 'InvoiceID';

    protected $fillable = [
        'InvoiceID',
        'Journal',
        'OrderedBy'
    ];

    protected $with = [
        'SalesInvoiceLines'
    ];

    public function SalesInvoiceLines(): HasMany
    {
        return $this->hasMany(SalesInvoiceLine::class, 'InvoiceID', 'InvoiceID');
    }
}
