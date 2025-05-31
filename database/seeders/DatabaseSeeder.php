<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ordem é importante devido às chaves estrangeiras
        $this->call([
            RoleSeeder::class,      // Cria papéis primeiro
            UserSeeder::class,      // Cria usuários e atribui papéis
            ClientSeeder::class,    // Cria clientes
            SupplierSeeder::class,  // Cria fornecedores
            ProductSeeder::class,   // Cria produtos (depende de fornecedores)
            SaleSeeder::class,      // Cria vendas (depende de clientes e produtos)
            EmployeeSeeder::class,  // Cria funcionários
            ProjectSeeder::class,   // Cria projetos (depende de funcionários)
            FinancialSeeder::class, // Cria financeiros (depende de vendas)
            ContractSeeder::class,  // Cria contratos (depende de clientes)
            ProductionOrderSeeder::class, // Cria ordens de produção (depende de produtos)
            TaxSeeder::class,       // Cria impostos (depende de vendas)
            BenefitSeeder::class,   // Cria benefícios (depende de funcionários)
            IdhMetricSeeder::class, // Cria métricas IDH
            LogSeeder::class,       // Cria logs (depende de usuários)
        ]);
    }
}
