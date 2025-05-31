<?php

namespace App\Http\Controllers\Admin\Benefit;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        $beneficios = Benefit::with('employee')->get();
        $funcionarios = Employee::all();
        return view('admin.benefits.list.index', ['data' => ['beneficios' => $beneficios, 'funcionarios' => $funcionarios]]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'benefit_type' => 'required|string|max:255',
            'amount' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $beneficio = Benefit::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Criação de Benefício',
            'descricao' => "Benefício {$beneficio->benefit_type} criado.",
        ]);

        return redirect()->route('admin.gestao.beneficios')->with('beneficioCadastrado', 'Benefício cadastrado');
    }

    public function update(Request $request, $id)
    {
        $beneficio = Benefit::findOrFail($id);
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'benefit_type' => 'required|string|max:255',
            'amount' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $beneficio->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'accao' => 'Atualização de Benefício',
            'descricao' => "Benefício {$beneficio->benefit_type} atualizado.",
        ]);

        return redirect()->route('admin.gestao.beneficios')->with('beneficioAtualizado', 'Benefício atualizado');
    }

    public function destroy($id)
    {
        $beneficio = Benefit::findOrFail($id);
        $beneficio->delete();

        Log::create([
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'accao' => 'Exclusão de Benefício',
            'descricao' => "Benefício {$beneficio->benefit_type} removido.",
        ]);

        return redirect()->route('admin.gestao.beneficios')->with('beneficioRemovido', 'Benefício removido');
    }
}
