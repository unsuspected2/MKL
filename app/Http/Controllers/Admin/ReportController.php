<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function financialReport(Request $request)
    {
        $query = Budget::query();

        // Aplicar filtros
        if ($request->filled('start_date')) {
            $query->whereDate('transaction_date', '>=', Carbon::parse($request->start_date));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('transaction_date', '<=', Carbon::parse($request->end_date));
        }
        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $transactions = $query->with('user')->get();
        $totalRevenue = $query->where('transaction_type', 'Receita')->sum('amount');
        $totalExpense = $query->where('transaction_type', 'Despesa')->sum('amount');

        // Dados para o gráfico
        $vendasPorMes = Budget::where('transaction_type', 'Receita')
            ->selectRaw('DATE_FORMAT(transaction_date, "%Y-%m") as mes, SUM(amount) as total')
            ->where('transaction_date', '>=', Carbon::now()->subMonths(6))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->pluck('total', 'mes')
            ->toArray();

        $meses = array_keys($vendasPorMes);
        $valores = array_values($vendasPorMes);

        return view('admin.reports.financial', compact('transactions', 'totalRevenue', 'totalExpense', 'meses', 'valores'));
    }
}
