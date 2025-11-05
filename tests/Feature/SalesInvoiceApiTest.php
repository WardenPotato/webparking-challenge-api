<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

pest()->use(RefreshDatabase::class);

test('test_proper_validation', function () {
    //Test valid scenario
    $response = $this->postJson('/api/sales-invoices', [
        'InvoiceID' => '3f4d7914-f369-4448-97d5-155b6ca531bc',
        'Journal' => '3f4e7914-f379-4448-97d5-155b6ca531bc',
        'OrderedBy' => '3f4e7914-f399-4448-97d5-155b6ca531bc',
        'SalesInvoiceLines' => [
            [
                'GLAccount' => '3f4e7914-f369-4548-97d5-155b6ca531bc',
                'InvoiceID' => '3f4d7914-f369-4448-97d5-155b6ca531bc',
                'Item' => '3f4e7914-f369-4458-97d5-155b6ca531bc'
            ]
        ]
    ]);

    $response
        ->assertStatus(201);
    $this->assertDatabaseCount('sales_invoices', 1);
    $this->assertDatabaseCount('sales_invoice_lines', 1);

    //Test invalid scenario
    $response_invalid = $this->postJson('/api/sales-invoices', [
        'InvoiceID' => '3f4d7914-f369-4448-97d5-155b6ca531bc',
    ]);

    $response_invalid
        ->assertStatus(422)
        ->assertJsonValidationErrors(['Journal', 'OrderedBy', 'SalesInvoiceLines']);
});
