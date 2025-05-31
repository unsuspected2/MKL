<?php

namespace App\Http\Controllers\Admin\Tax;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
{
    $impostos = Tax::all();
    $vendas = Sale::all(); // Substitua por sua lógica de busca de vendas
    return view('admin.taxes.list.index', [
        'data' => [
            'impostos' => $impostos,
            'vendas' => $vendas
        ]
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tax_type' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|string|in:Pendente,Pago',
            'notes' => 'nullable|string',
        ]);

        $imposto = Tax::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Criação de Imposto',
            'descricao' => "Imposto {$imposto->tax_type} criado.",
        ]);

        return redirect()->route('admin.gestao.impostos')->with('impostoCadastrado', 'Imposto cadastrado');
    }

    public function update(Request $request, $id)
    {
        $imposto = Tax::findOrFail($id);
        $validated = $request->validate([
            'tax_type' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|string|in:Pendente,Pago',
            'notes' => 'nullable|string',
        ]);

        $imposto->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Atualização de Imposto',
            'descricao' => "Imposto {$imposto->tax_type} atualizado.",
        ]);

        return redirect()->route('admin.gestao.impostos')->with('impostoAtualizado', 'Imposto atualizado');
    }

}
