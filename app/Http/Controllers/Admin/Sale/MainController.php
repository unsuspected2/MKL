<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Models\Log;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the sales.
     */
    public function index()
    {
          $clients = Client::orderBy('nome')->get();
        $products = Product::orderBy('nome')->get();

        $sales = Sale::with(['client', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.sales.list.index', compact('sales', 'clients', 'products'));
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create()
    {
        $clients = Client::orderBy('nome')->get();
        $products = Product::orderBy('nome')->get();

        return view('admin.sales.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:client,id',
            'id_product' => 'required|exists:product,id',
            'quantidade' => 'required|integer|min:1',
            'data_venda' => 'required|date',
        ]);

        // Busca o preço do produto
        $product = Product::findOrFail($validated['id_product']);
        $client = Client::findOrFail($validated['id_cliente']);
        $total = $product->preco * $validated['quantidade'];

        // Cria a venda
        $sale = Sale::create([
            'id_cliente' => $validated['id_cliente'],
            'id_product' => $validated['id_product'],
            'quantidade' => $validated['quantidade'],
            'data_venda' => $validated['data_venda'],
            'total' => $total,
        ]);

        // Cria o log
        Log::create([
            'user_id' => auth()->id(),
            'id_user' => auth()->id(), // Remova se a coluna id_user não for necessária
            'ip' => $request->ip(),
            'accao' => 'Criação de Venda',
            'descricao' => "Usuário " . auth()->id() . " cadastrou a venda do produto {$product->nome} (ID: {$sale->id_product}) para o cliente {$client->nome} (ID: {$sale->id_cliente}) na data {$sale->data_venda}.",
        ]);

        return redirect()->route('admin.gestao.vendas')
            ->with('vendaCadastrado', 'Venda cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified sale.
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $clients = Client::orderBy('nome')->get();
        $products = Product::orderBy('nome')->get();

        return view('admin.sales.edit', compact('sale', 'clients', 'products'));
    }

    /**
     * Update the specified sale in storage.
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        $validated = $request->validate([
            'id_cliente' => 'required|exists:client,id',
            'id_product' => 'required|exists:product,id',
            'quantidade' => 'required|integer|min:1',
            'data_venda' => 'required|date',
        ]);

        // Busca o preço do produto
        $product = Product::findOrFail($validated['id_product']);
        $client = Client::findOrFail($validated['id_cliente']);
        $total = $product->preco * $validated['quantidade'];

        // Atualiza a venda
        $sale->update([
            'id_cliente' => $validated['id_cliente'],
            'id_product' => $validated['id_product'],
            'quantidade' => $validated['quantidade'],
            'data_venda' => $validated['data_venda'],
            'total' => $total,
        ]);

        // Cria o log
        Log::create([
            'user_id' => auth()->id(),
            'id_user' => auth()->id(), // Remova se a coluna id_user não for necessária
            'ip' => $request->ip(),
            'accao' => 'Atualização de Venda',
            'descricao' => "Usuário " . auth()->id() . " atualizou a venda do produto {$product->nome} (ID: {$sale->id_product}) para o cliente {$client->nome} (ID: {$sale->id_cliente}) na data {$sale->data_venda}.",
        ]);

        return redirect()->route('admin.gestao.vendas')
            ->with('vendaAtualizado', 'Venda atualizada com sucesso!');
    }

    /**
     * Remove the specified sale from storage.
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $product = Product::findOrFail($sale->id_product);
        $client = Client::findOrFail($sale->id_cliente);

        // Cria o log antes de excluir
        Log::create([
            'user_id' => auth()->id(),
            'id_user' => auth()->id(), // Remova se a coluna id_user não for necessária
            'ip' => request()->ip(),
            'accao' => 'Exclusão de Venda',
            'descricao' => "Usuário " . auth()->id() . " removeu a venda do produto {$product->nome} (ID: {$sale->id_product}) para o cliente {$client->nome} (ID: {$sale->id_cliente}) na data {$sale->data_venda}.",
        ]);

        $sale->delete();

        return redirect()->route('admin.gestao.vendas')
            ->with('vendaRemovido', 'Venda removida com sucesso!');
    }
}
