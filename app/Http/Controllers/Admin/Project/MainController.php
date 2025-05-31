<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        $projetos = Project::with('client')->get();
        $clientes = Client::all();
        return view('admin.projects.index', ['data' => ['projetos' => $projetos, 'clientes' => $clientes]]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:Planejado,Em Andamento,Concluído,Cancelado',
            'client_id' => 'required|exists:clients,id',
        ]);

        $projeto = Project::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Criação de Projeto',
            'descricao' => "Projeto {$projeto->title} criado.",
        ]);

        return redirect()->route('admin.gestao.projetos')->with('projetoCadastrado', 'Projeto cadastrado');
    }

    public function update(Request $request, $id)
    {
        $projeto = Project::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:Planejado,Em Andamento,Concluído,Cancelado',
            'client_id' => 'required|exists:clients,id',
        ]);

        $projeto->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Atualização de Projeto',
            'descricao' => "Projeto {$projeto->title} atualizado.",
        ]);

        return redirect()->route('admin.gestao.projetos')->with('projetoAtualizado', 'Projeto atualizado');
    }

    public function destroy($id)
    {
        $projeto = Project::findOrFail($id);
        $projeto->delete();

        Log::create([
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'accao' => 'Exclusão de Projeto',
            'descricao' => "Projeto {$projeto->title} removido.",
        ]);

        return redirect()->route('admin.gestao.projetos')->with('projetoRemovido', 'Projeto removido');
    }
}
