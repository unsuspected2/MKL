<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Log;

class MainController extends Controller
{
    public function index()
    {
        $projetos = Project::with('responsible')->get();
        $Funcionario = Employee::all();
        return view('admin.projects.list.index', ['data' => ['projetos' => $projetos, 'funcionarios' => $Funcionario]]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:Planejado,Em Andamento,Concluído,Cancelado',
            'budget' => 'required|numeric|min:0', // Corrigido para valor numérico
            'responsible_id' => 'required|exists:employees,id', // Corrigido para employees (não clients)
        ]);

        $projeto = Project::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Criação de Projeto',
            'descricao' => "Projeto {$projeto->name} criado.", // Corrigido para name (não title)
        ]);

        return redirect()->route('admin.gestao.projetos')->with('projetoCadastrado', 'Projeto cadastrado');
    }

   public function update(Request $request, $id)
    {
        $projeto = Project::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Corrigido para name (não title)
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:Planejado,Em Andamento,Concluído,Cancelado',
            'budget' => 'required|numeric|min:0', // Adicionado
            'responsible_id' => 'required|exists:employees,id', // Corrigido para employees
        ]);

        $projeto->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Atualização de Projeto',
            'descricao' => "Projeto {$projeto->name} atualizado.", // Corrigido para name
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
