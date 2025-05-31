<?php

namespace App\Http\Controllers\Admin\ProductionOrder;

use App\Http\Controllers\Controller;
use App\Models\ProductionOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        $ordens = ProductionOrder::with('product')->get();
        $produtos = Product::all();
        return view('admin.production_orders.list.index', ['data' => ['ordens_producao' => $ordens, 'produtos' => $produtos]]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string|in:Agendado,Em Andamento,Concluído',
            'raw_materials' => 'nullable|string',
        ]);

        $ordem = ProductionOrder::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Criação de Ordem de Produção',
            'descricao' => "Ordem de Produção para produto ID {$ordem->product_id} criada.",
        ]);

        return redirect()->route('admin.gestao.ordens-producao')->with('ordemProducaoCadastrada', 'Ordem de Produção cadastrada');
    }

    public function update(Request $request, $id)
    {
        $ordem = ProductionOrder::findOrFail($id);
        $validated = $request->validate([
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string|in:Agendado,Em Andamento,Concluído',
            'raw_materials' => 'nullable|string',
        ]);

        $ordem->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Atualização de Ordem de Produção',
            'descricao' => "Ordem de Produção para produto ID {$ordem->product_id} atualizada.",
        ]);

        return redirect()->route('admin.gestao.ordens-producao')->with('ordemProducaoAtualizada', 'Ordem de Produção atualizada');
    }

    public function destroy($id)
    {
        $ordem = ProductionOrder::findOrFail($id);
        $ordem->delete();

        Log::create([
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'accao' => 'Exclusão de Ordem de Produção',
            'descricao' => "Ordem de Produção para produto ID {$ordem->product_id} removida.",
        ]);

        return redirect()->route('admin.gestao.ordens-producao')->with('ordemProducaoRemovida', 'Ordem de Produção removida');
    }
}
