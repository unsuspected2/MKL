<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        $funcionarios = Employee::all();
        return view('admin.employees.list.index', ['data' => ['funcionarios' => $funcionarios]]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'telefone' => 'nullable|string|max:20',
            'cargo' => 'required|string|max:255',
            'data_contratacao' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        $funcionario = Employee::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Criação de Funcionário',
            'descricao' => "Funcionário {$funcionario->nome} criado.",
        ]);

        return redirect()->route('admin.gestao.funcionarios')->with('funcionarioCadastrado', 'Funcionário cadastrado');
    }

    public function update(Request $request, $id)
    {
        $funcionario = Employee::findOrFail($id);
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'telefone' => 'nullable|string|max:20',
            'cargo' => 'required|string|max:255',
            'data_contratacao' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        $funcionario->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Atualização de Funcionário',
            'descricao' => "Funcionário {$funcionario->nome} atualizado.",
        ]);

        return redirect()->route('admin.gestao.funcionarios')->with('funcionarioAtualizado', 'Funcionário atualizado');
    }

    public function destroy($id)
    {
        $funcionario = Employee::findOrFail($id);
        $funcionario->delete();

        Log::create([
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'accao' => 'Exclusão de Funcionário',
            'descricao' => "Funcionário {$funcionario->nome} removido.",
        ]);

        return redirect()->route('admin.gestao.funcionarios')->with('funcionarioRemovido', 'Funcionário removido');
    }
}
