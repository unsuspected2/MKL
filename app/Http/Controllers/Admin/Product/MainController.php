<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           /* CRIAÇÃO DE UM NOVO RESITRO NA TABELA Produto*/

        $produto = Product::create([
            'nome' => $request->name,      // Atribua o valor do campo 'name' do request
            'descricao' => $request->inform,    // Atribua o valor do campo 'descricao' do request
            'preco' => $request->price ,// Atribua o valor do campo 'price' do request
            'quantidade_disponivel' => $request->quantity,    // Atribua o valor do campo 'quntity' do request
            'categoria' => $request->category,    // Atribua o valor do campo 'quntity' do request
            'imagem' => 'valor_teste',    // Atribua o valor do campo 'imagem' do request
            'id_fornecedor' => $request->supplier_name, // Cadasrada o Id do forncedor para e na view sera exibido seu nome!


        ]);

        $user_id= auth()->id();  
  

        /* CRIAÇÃO DO LOG */
        Log::create([
            'user_id' =>$user_id,
            'ip' => $request->ip(),
            'accao' => 'Cadastramento',
            'id_user' => $user_id,
            'descricao' => "Usuário {$user_id} cadastrou o produto {$produto->nome} com ID {$produto->id}.",
        ]);

        return redirect()->back()->with('produtoCadastrado', 'Cadastrado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)

    {
         // Localizar o cliente
    $produto = Product::findOrFail($id);

    // Atualizar os dados do cliente
    $produto->update([
        'nome' => $request->name,      // Atribua o valor do campo 'name' do request
        'descricao' => $request->inform,    // Atribua o valor do campo 'descricao' do request
        'preco' => $request->price ,// Atribua o valor do campo 'price' do request
        'quantidade_disponivel' => $request->quantity,    // Atribua o valor do campo 'quntity' do request
        'categoria' => $request->category,    // Atribua o valor do campo 'quntity' do request
        'imagem' => 'valor_teste',    // Atribua o valor do campo 'imagem' do request
        'id_fornecedor' => $request->supplier_name, // Cadasrada o Id do forncedor para e na view sera exibido seu nome!
    ]);

    // Criar log
    $user_id = auth()->id();
    Log::create([
        'user_id' => $user_id,
        'ip' => $request->ip(),
        'accao' => 'Atualização',
        'id_user' => $user_id,
        'descricao' => "Usuário {$user_id} atualizou o produto {$produto->nome} com ID {$produto->id}.",
    ]);

    return redirect()->back()->with('clienteAtualizado', 'Atualizado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
          // Localizar o produto
    $produto = Product::findOrFail($id);

    // Capturar o nome do produto antes de excluir
    $nomeProduto = $produto->nome;

    // Excluir o produto
    $produto->delete();

    // Criar log
    $user_id = auth()->id();
    Log::create([
        'user_id' => $user_id,
        'ip' => $request->ip(),
        'accao' => 'Eliminação',
        'id_user' => $user_id,
        'descricao' => "Usuário {$user_id} eliminou o produto {$nomeProduto} com ID {$id}.",
    ]);

    return redirect()->back()->with('produtoEliminado', 'Produto eliminado com sucesso.');
    }
}
