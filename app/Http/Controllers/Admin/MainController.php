<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Sale;
use App\Models\Log;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;


use Illuminate\Http\Request;

class MainController extends Controller

{
    public function index(){
        $data['clientes'] = Client::count();
        $data['produtos'] = Product::count();
        $data['fornecedores'] = Supplier::count();
        $ultimosClientes = Client::latest()->take(5)->get();
        $ultimosProdutos = Product::latest()->take(5)->get();
        $ultimosFornecedores = Supplier::latest()->take(5)->get();
       

        return view('admin.dashboard.index', ['data'=> $data, 
        'ultimosClientes' => $ultimosClientes,
        'ultimosProdutos' => $ultimosProdutos,
        'ultimosFornecedores' => $ultimosFornecedores,
    ]);
        
    }

    public function list_clients(){
        $data['clientes'] = Client::orderBy('id', 'desc')->get(); 
        return view('admin.clients.table', ['data' => $data]);
    }

    public function list_products(){
        $data ['produtos']  = Product::join('supplier', 'product.id_fornecedor' , 'supplier.id')
        ->select('product.*' , 'supplier.nome as nome_fornecedor')->orderBy('id' , 'desc')->get();
        return view('admin.products.table', ['data' => $data]); 
    }

    public function list_suppliers(){
        $data['fornecedores'] = Supplier::orderBy('id', 'desc')->get(); 
        return view('admin.suppliers.table' ,['data' => $data]); 
    }

    public function list_sales(){
        $data['vendas'] = Sale::join('client' , 'sale.id_cliente' , 'client.id')
        ->join('product' , 'sale.id_product' , 'product.id')
        ->select('sale.*' ,
        'client.nome as nome_cliente ', 
        'product.nome as nome_produto ', 
        'product.preco as preco_produto ', 
        )->orderby('id' , 'desc')->get();
         
        return view('admin.sales.table' ,['data' => $data]); 
    }

    public function list_logs(){
        $data['user'] = auth()->user();
        $data['logs'] = Log::join('users' , 'log.id_user' , 'users.id')
        ->select('log.*' , 'users.id as id_user' , 'users.name as nome_user')->orderBy('id','desc')->get(); 
        return view('admin.logs.table',['data' => $data]); 
    }
}
