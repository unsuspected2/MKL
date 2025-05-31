<?php

namespace Database\Seeders;

use App\Models\Financial;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class FinancialSeeder extends Seeder
{
    public function run(): void
    {
        $sale = Sale::first();

        Financial::create([
            'type' => 'Receivable',
            'amount' => 500.00,
            'due_date' => '2025-06-01',
            'status' => 'Pending',
            'description' => 'Pagamento de venda',
            'sale_id' => $sale->id,
        ]);

        Financial::create([
            'type' => 'Payable',
            'amount' => 300.00,
            'due_date' => '2025-05-15',
            'status' => 'Paid',
            'description' => 'Pagamento de fornecedor',
            'sale_id' => null,
        ]);
    }
}
