<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:204800', // Validação para imagem
        ]);

        // Lidar com o upload da imagem
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('employees', 'public');
        }

        $funcionario = Employee::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Criação de Funcionário',
            'id_user' => auth()->id(), // Adicionado para compatibilidade com a tabela log
            'descricao' => "Funcionário {$funcionario->name} criado.",
        ]);

        return redirect()->route('admin.gestao.funcionarios')->with('funcionarioCadastrado', 'Funcionário cadastrado');
    }

    public function update(Request $request, $id)
    {
        $funcionario = Employee::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:204800', // Validação para imagem
        ]);

        // Lidar com o upload da imagem
        if ($request->hasFile('image')) {
            // Excluir a imagem antiga, se existir
            if ($funcionario->image) {
                Storage::disk('public')->delete($funcionario->image);
            }
            $validated['image'] = $request->file('image')->store('employees', 'public');
        } else {
            // Manter a imagem existente
            $validated['image'] = $funcionario->image;
        }

        $funcionario->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Atualização de Funcionário',
            'id_user' => auth()->id(), // Adicionado para compatibilidade com a tabela log
            'descricao' => "Funcionário {$funcionario->name} atualizado.",
        ]);

        return redirect()->route('admin.gestao.funcionarios')->with('funcionarioAtualizado', 'Funcionário atualizado');
    }

    public function destroy($id)
    {
        $funcionario = Employee::findOrFail($id);
        $nomeFuncionario = $funcionario->name;

        // Excluir a imagem, se existir
        if ($funcionario->image) {
            Storage::disk('public')->delete($funcionario->image);
        }

        $funcionario->delete();

        Log::create([
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'accao' => 'Exclusão de Funcionário',
            'id_user' => auth()->id(), // Adicionado para compatibilidade com a tabela log
            'descricao' => "Funcionário {$nomeFuncionario} removido.",
        ]);

        return redirect()->route('admin.gestao.funcionarios')->with('funcionarioRemovido', 'Funcionário removido');
    }
}
