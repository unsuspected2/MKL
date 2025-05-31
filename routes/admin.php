<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Employee\MainController as EmployeeController;
use App\Http\Controllers\Admin\Project\MainController as ProjectController;
use App\Http\Controllers\Admin\Financial\MainController as FinancialController;
use App\Http\Controllers\Admin\Contract\MainController as ContractController;
use App\Http\Controllers\Admin\ProductionOrder\MainController as ProductionOrderController;
use App\Http\Controllers\Admin\Tax\MainController as TaxController;
use App\Http\Controllers\Admin\Benefit\MainController as BenefitController;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:admin|gestor|contabilista|marketing|juridico|rh|producao']
], function () {
    Route::get('/dashboard', 'Admin\MainController@index')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::prefix('/gestao')->group(function () {
        Route::prefix('/clientes')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.clientes', 'uses' => 'Admin\MainController@list_clients']);
            Route::post('cadastrar', ['as' => 'admin.gestao.cliente.cadastrar', 'uses' => 'Admin\Client\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.cliente.editar', 'uses' => 'Admin\Client\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.cliente.apagar', 'uses' => 'Admin\Client\MainController@destroy']);
        });

        Route::prefix('/produtos')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.produtos', 'uses' => 'Admin\MainController@list_products']);
            Route::post('cadastrar', ['as' => 'admin.gestao.produto.cadastrar', 'uses' => 'Admin\Product\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.produto.editar', 'uses' => 'Admin\Product\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.produto.apagar', 'uses' => 'Admin\Product\MainController@destroy']);
        });

        Route::prefix('/fornecedores')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.fornecedores', 'uses' => 'Admin\MainController@list_suppliers']);
            Route::post('cadastrar', ['as' => 'admin.gestao.fornecedor.cadastrar', 'uses' => 'Admin\Supplier\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.fornecedor.editar', 'uses' => 'Admin\Supplier\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.fornecedor.apagar', 'uses' => 'Admin\Supplier\MainController@destroy']);
        });

        Route::prefix('/vendas')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.vendas', 'uses' => 'Admin\MainController@list_sales']);
            Route::post('cadastrar', ['as' => 'admin.gestao.venda.cadastrar', 'uses' => 'Admin\Sale\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.venda.editar', 'uses' => 'Admin\Sale\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.venda.apagar', 'uses' => 'Admin\Sale\MainController@destroy']);
        });

        Route::prefix('/funcionarios')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.funcionarios', 'uses' => 'Admin\Employee\MainController@index']);
            Route::post('cadastrar', ['as' => 'admin.gestao.funcionario.cadastrar', 'uses' => 'Admin\Employee\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.funcionario.editar', 'uses' => 'Admin\Employee\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.funcionario.apagar', 'uses' => 'Admin\Employee\MainController@destroy']);
        });

        Route::prefix('/projetos')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.projetos', 'uses' => 'Admin\Project\MainController@index']);
            Route::post('cadastrar', ['as' => 'admin.gestao.projeto.cadastrar', 'uses' => 'Admin\Project\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.projeto.editar', 'uses' => 'Admin\Project\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.projeto.apagar', 'uses' => 'Admin\Project\MainController@destroy']);
        });

        Route::prefix('/financeiro')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.financeiro', 'uses' => 'Admin\Financial\MainController@index']);
            Route::post('cadastrar', ['as' => 'admin.gestao.financeiro.cadastrar', 'uses' => 'Admin\Financial\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.financeiro.editar', 'uses' => 'Admin\Financial\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.financeiro.apagar', 'uses' => 'Admin\Financial\MainController@destroy']);
        });

        Route::prefix('/contratos')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.contratos', 'uses' => 'Admin\Contract\MainController@index']);
            Route::post('cadastrar', ['as' => 'admin.gestao.contrato.cadastrar', 'uses' => 'Admin\Contract\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.contrato.editar', 'uses' => 'Admin\Contract\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.contrato.apagar', 'uses' => 'Admin\Contract\MainController@destroy']);
        });

        Route::prefix('/ordens-producao')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.ordens-producao', 'uses' => 'Admin\ProductionOrder\MainController@index']);
            Route::post('cadastrar', ['as' => 'admin.gestao.ordem-producao.cadastrar', 'uses' => 'Admin\ProductionOrder\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.ordem-producao.editar', 'uses' => 'Admin\ProductionOrder\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.ordem-producao.apagar', 'uses' => 'Admin\ProductionOrder\MainController@destroy']);
        });

        Route::prefix('/impostos')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.impostos', 'uses' => 'Admin\Tax\MainController@index']);
            Route::post('cadastrar', ['as' => 'admin.gestao.imposto.cadastrar', 'uses' => 'Admin\Tax\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.imposto.editar', 'uses' => 'Admin\Tax\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.imposto.apagar', 'uses' => 'Admin\Tax\MainController@destroy']);
        });

        Route::prefix('/beneficios')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.beneficios', 'uses' => 'Admin\Benefit\MainController@index']);
            Route::post('cadastrar', ['as' => 'admin.gestao.beneficio.cadastrar', 'uses' => 'Admin\Benefit\MainController@store']);
            Route::post('editar/{id}', ['as' => 'admin.gestao.beneficio.editar', 'uses' => 'Admin\Benefit\MainController@update']);
            Route::get('apagar/{id}', ['as' => 'admin.gestao.beneficio.apagar', 'uses' => 'Admin\Benefit\MainController@destroy']);
        });

        Route::prefix('/atividades')->group(function () {
            Route::get('/', ['as' => 'admin.gestao.atividades', 'uses' => 'Admin\MainController@list_logs']);
        });
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
