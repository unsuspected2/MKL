
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;


Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin',
    'middleware' => 'auth'
], function(){

    /* dashboard */
    Route::get('/dashboard', 'Admin\MainController@index')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    

    /*  Gestao*/
    Route::prefix('/gestao')->group(function(){

        /* clientes */
        Route::prefix('/clientes')->group(function(){
            Route::get('/', ['as'=>'admin.gestao.clientes','uses'=>'Admin\MainController@list_clients']);
            Route::post('cadastrar', ['as'=>'admin.gestao.cliente.cadastrar','uses'=>'Admin\Client\MainController@store']);
            Route::post('editar/{id}', ['as'=>'admin.gestao.cliente.editar','uses'=>'Admin\Client\MainController@update']);
            Route::get('apagar/{id}', ['as'=>'admin.gestao.cliente.apagar','uses'=>'Admin\Client\MainController@destroy']);
        });

         /* produtos */
         Route::prefix('/produtos')->group(function(){
            Route::get('/', ['as'=>'admin.gestao.produtos','uses'=>'Admin\MainController@list_products']);
            Route::post('cadastrar', ['as'=>'admin.gestao.produto.cadastrar','uses'=>'Admin\Product\MainController@store']);
            Route::post('editar/{id}', ['as'=>'admin.gestao.produto.editar','uses'=>'Admin\Product\MainController@update']);
            Route::get('apagar/{id}', ['as'=>'admin.gestao.produto.apagar','uses'=>'Admin\Product\MainController@destroy']);

        });

         /* fornecedores */
         Route::prefix('/fornecedores')->group(function(){
            Route::get('/', ['as'=>'admin.gestao.fornecedores','uses'=>'Admin\MainController@list_suppliers']);
            Route::post('cadastrar', ['as'=>'admin.gestao.fornecedor.cadastrar','uses'=>'Admin\Supplier\MainController@store']);
            Route::post('editar/{id}', ['as'=>'admin.gestao.fornecedor.editar','uses'=>'Admin\Supplier\MainController@update']);
            Route::get('apagar/{id}', ['as'=>'admin.gestao.fornecedor.apagar','uses'=>'Admin\Supplier\MainController@destroy']);

        });

         /* vendas */
         Route::prefix('/vendas')->group(function(){
            Route::get('/', ['as'=>'admin.gestao.vendas','uses'=>'Admin\MainController@list_sales']);
            Route::post('cadastrar', ['as'=>'admin.gestao.venda.cadastrar','uses'=>'Admin\Sale\MainController@store']);
            Route::post('editar/{id}', ['as'=>'admin.gestao.venda.editar','uses'=>'Admin\Sale\MainController@update']);
            Route::get('apagar/{id}', ['as'=>'admin.gestao.venda.apagar','uses'=>'Admin\Sale\MainController@destroy']);

        });

        Route::prefix('/atividades')->group(function(){
            Route::get('/', ['as'=>'admin.gestao.atividades','uses'=>'Admin\MainController@list_logs']);
            /* Route::post('cadastrar', ['as'=>'admin.gestao.cidadaos.cadastrar','uses'=>'Admin\Cidadao\MainController@create_cidadao']);
            Route::post('editar/{id}', ['as'=>'admin.gestao.cidadao.editar','uses'=>'Admin\Cidadao\MainController@edit_cidadao']); */
        });
 
    });

    /* perfil */
    Route::prefix('/profile')->group(function(){
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
   

});


require __DIR__.'/auth.php';