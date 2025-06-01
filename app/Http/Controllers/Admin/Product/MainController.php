<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Supplier;

class MainController extends Controller
{
    /**
     * Validação comum para store e update
     */

    public function list_products()
    {
        $data['produtos'] = Product::join('supplier', 'product.id_fornecedor', 'supplier.id')
            ->select('product.*', 'supplier.nome as nome_fornecedor')
            ->orderBy('product.id', 'desc')
            ->get();
        return view('admin.products.list.index', ['data' => $data]);
    }

    protected function validateProduct(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'inform' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'supplier_name' => 'required|exists:supplier,id'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        try {
            $produto = Product::create([
                'nome' => $validated['name'],
                'descricao' => $validated['inform'],
                'preco' => $validated['price'],
                'quantidade_disponivel' => $validated['quantity'],
                'categoria' => $validated['category'],
                'imagem' => 'default.jpg', // Valor temporário
                'id_fornecedor' => $validated['supplier_name'],
            ]);

            // Log
            $user_id = auth()->id();
            Log::create([
                'user_id' => $user_id,
                'ip' => $request->ip(),
                'accao' => 'Cadastramento',
                'id_user' => $user_id,
                'descricao' => "Usuário {$user_id} cadastrou o produto {$produto->nome} com ID {$produto->id}.",
            ]);

            return redirect()->route('admin.gestao.produtos')
                   ->with('produtoCadastrado', 'Produto cadastrado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                   ->withInput()
                   ->withErrors(['error' => 'Erro ao cadastrar produto: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateProduct($request);

        try {
            $produto = Product::findOrFail($id);

            $produto->update([
                'nome' => $validated['name'],
                'descricao' => $validated['inform'],
                'preco' => $validated['price'],
                'quantidade_disponivel' => $validated['quantity'],
                'categoria' => $validated['category'],
                'id_fornecedor' => $validated['supplier_name'],
            ]);

            // Log
            $user_id = auth()->id();
            Log::create([
                'user_id' => $user_id,
                'ip' => $request->ip(),
                'accao' => 'Atualização',
                'id_user' => $user_id,
                'descricao' => "Usuário {$user_id} atualizou o produto {$produto->nome} com ID {$produto->id}.",
            ]);

            return redirect()->route('admin.gestao.produtos')
                   ->with('produtoAtualizado', 'Produto atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                   ->withInput()
                   ->withErrors(['error' => 'Erro ao atualizar produto: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $produto = Product::findOrFail($id);
            $nomeProduto = $produto->nome;

            $produto->delete();

            // Log
            $user_id = auth()->id();
            Log::create([
                'user_id' => $user_id,
                'ip' => $request->ip(),
                'accao' => 'Eliminação',
                'id_user' => $user_id,
                'descricao' => "Usuário {$user_id} eliminou o produto {$nomeProduto} com ID {$id}.",
            ]);

            return redirect()->route('admin.gestao.produtos')
                   ->with('produtoRemovido', 'Produto removido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                   ->withErrors(['error' => 'Erro ao remover produto: ' . $e->getMessage()]);
        }
    }
}
