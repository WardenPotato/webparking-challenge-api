<?php

use App\Models\Exact\SalesInvoice;
use App\Services\ExactOnlineService;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Mockery;

test('exact_service_logging', function () {
    $invoice = Mockery::mock(SalesInvoice::class)->makePartial();

    $invoice->InvoiceID = '3f4d7914-f369-4448-97d5-155b6ca531bc';
    $invoice->Journal = '3f4e7914-f379-4448-97d5-155b6ca531bc';
    $invoice->OrderedBy = '3f4e7914-f399-4448-97d5-155b6ca531bc';
    $invoice->SalesInvoiceLines = collect([
        (object)[
            'GLAccount' => '3f4e7914-f369-4548-97d5-155b6ca531bc',
            'Item' => '3f4e7914-f369-4458-97d5-155b6ca531bc'
        ]
    ]);

    Log::shouldReceive('info')
        ->once()
        ->withArgs(function ($message, $context) use ($invoice) {
            return $message === 'Forwarding Sales Invoice to Exact Online'
                && $context['InvoiceID'] === $invoice->InvoiceID
                && $context['Journal'] === $invoice->Journal
                && $context['OrderedBy'] === $invoice->OrderedBy
                && $context['SalesInvoiceLines'] === $invoice->SalesInvoiceLines;
        });


    $service = new \App\Services\ExactOnlineService();
    $result = $service->sendInvoice($invoice);

    $this->assertTrue($result);
});
