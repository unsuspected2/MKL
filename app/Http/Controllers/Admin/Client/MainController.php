<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


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
     * Store a newly created resource in DB.
     */
    public function store(Request $request)
    {
       /*  try { */
        /*   $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'provincia' => 'required|string|max:100',
            
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'phone.required' => 'O campo contacto é obrigatório.',
            'province.required' => 'O campo é obrigatório.',    
        ]); */

        /* CRIAÇÃO DE UM NOVO RESITRO NA TABELA CLIENTE */

        $cliente = Client::create([
            'nome' => $request->name,      // Atribua o valor do campo 'name' do request
            'numero' => $request->phone,    // Atribua o valor do campo 'phone' do request
            'provincia' => $request->province ,// Atribua o valor do campo 'province' do request
            'imagem' => 'valor_teste',    // Atribua o valor do campo 'phone' do request
        ]);

        $user_id= auth()->id();  
  

        /* CRIAÇÃO DO LOG */
        Log::create([
            'user_id' =>$user_id,
            'ip' => $request->ip(),
            'accao' => 'Cadastramento',
            'id_user' => $user_id,
            'descricao' => "Usuário {$user_id} cadastrou o/a cliente {$cliente->nome} com ID {$cliente->id}.",
        ]);

        return redirect()->back()->with('clienteCadastrado', 'Cadastrado');


       /* } catch (\Exception $e) {
          return response()->json(['message' => 'Houve um erro no servidor'], 500); */
      
     
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }



    /**
     * Update the specified resource in DB.
     */
    public function update(Request $request, $id)
    {
        
        // Validação dos dados
         /* $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'provincia' => 'required|string|max:100',
            
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'phone.required' => 'O campo contacto é obrigatório.',
            'province.required' => 'O campo é obrigatório.',    
        ]); */ 

    // Localizar o cliente
    $cliente = Client::findOrFail($id);

    // Atualizar os dados do cliente
    $cliente->update([
        'nome' => $request->name,
        'numero' => $request->phone,
        'provincia' => $request->province,
    ]);

    // Criar log
    $user_id = auth()->id();
    Log::create([
        'user_id' => $user_id,
        'ip' => $request->ip(),
        'accao' => 'Atualização',
        'id_user' => $user_id,
        'descricao' => "Usuário {$user_id} atualizou o/a cliente {$cliente->nome} com ID {$cliente->id}.",
    ]);

    return redirect()->back()->with('clienteAtualizado', 'Atualizado');

    }

    /**
     * Remove the specified resource from DB.
     */
    public function destroy(Request $request , $id)
    {
             // Localizar o cliente
    $cliente = Client::findOrFail($id);

     // Capturar o nome do produto antes de excluir
     $nomeCliente = $cliente->nome;

    // Remover o cliente
    $cliente->delete();


    // Criar log antes da remoção
    $user_id = auth()->id();
    Log::create([
        'user_id' => $user_id,
        'ip' => $request->ip(),
        'accao' => 'Eliminação',
        'id_user' => $user_id,
        'descricao' => "Usuário {$user_id} eliminou o cliente {$nomeCliente} com ID {$id}.",
    ]);


    return redirect()->back()->with('clienteRemovido', 'Eliminado');
    }

}
