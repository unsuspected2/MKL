@extends('layouts.admin.body')

@section('title', 'Saques e Empréstimos')

@section('conteudo')
    <div class="container-fluid">
        <h4 class="mb-3"><strong>Saques e Empréstimos</strong></h4>
        <p class="mb-4">Gerencie as transações de saques e empréstimos da MK LDA.</p>

        <!-- Mensagens de Feedback -->
        @if (session('withdrawalCadastrado'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('withdrawalCadastrado') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('loanCadastrado'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('loanCadastrado') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('transactionAtualizada'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('transactionAtualizada') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('transactionRemovida'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('transactionRemovida') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('transactionRestaurada'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('transactionRestaurada') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Botões para abrir modais -->
        <div class="mb-4">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalWithdrawal">
                <i class="ti ti-minus me-1"></i> Novo Saque
            </button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalLoan">
                <i class="ti ti-plus me-1"></i> Novo Empréstimo
            </button>
        </div>

        <!-- Tabela de Transações Ativas -->
        <div class="shadow-sm card">
            <div class="card-header bg-light">
                <h5 class="mb-0 card-title">Lista de Transações Ativas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Valor (AOA)</th>
                                <th>Saldo (AOA)</th>
                                <th>Descrição</th>
                                <th>Data</th>
                                <th>Responsável</th>
                                <th>Criado Em</th>
                                <th>Atualizado Em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['transactions'] as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->transaction_type === 'Saque' ? 'danger' : 'success' }}">
                                            {{ $transaction->transaction_type }}
                                        </span>
                                    </td>
                                    <td>{{ number_format(abs($transaction->amount), 2, ',', '.') }}</td>
                                    <td>{{ number_format($transaction->balance, 2, ',', '.') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $transaction->updated_at->format('d/m/Y H:i') }}</td>
                                    
                                    <td>
                                        <a href="{{ route('admin.gestao.withdrawal-loan.edit', $transaction->id) }}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('admin.gestao.withdrawal.delete', $transaction->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja eliminar esta transação?')">
                                                <i class="ti ti-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">Nenhuma transação registrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabela de Transações Excluídas -->
        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light">
                <h5 class="mb-0 card-title">Transações Excluídas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Valor (AOA)</th>
                                <th>Saldo (AOA)</th>
                                <th>Descrição</th>
                                <th>Data</th>
                                <th>Responsável</th>
                                <th>Excluído Em</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['deletedTransactions'] as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->transaction_type === 'Saque' ? 'danger' : 'success' }}">
                                            {{ $transaction->transaction_type }}
                                        </span>
                                    </td>
                                    <td>{{ number_format(abs($transaction->amount), 2, ',', '.') }}</td>
                                    <td>{{ number_format($transaction->balance, 2, ',', '.') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->deleted_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.gestao.withdrawal.restore', $transaction->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Tem certeza que deseja restaurar esta transação?')">
                                                <i class="ti ti-restore"></i> Restaurar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Nenhuma transação excluída.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal para Novo Saque -->
        <div class="modal fade" id="modalWithdrawal" tabindex="-1" aria-labelledby="modalWithdrawalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.gestao.withdrawal.cadastrar') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalWithdrawalLabel">Registrar Novo Saque</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="amount" class="form-label">Valor (AOA) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                           name="amount" value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="transaction_date" class="form-label">Data da Transação <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('transaction_date') is-invalid @enderror"
                                           name="transaction_date" value="{{ old('transaction_date') }}" required>
                                    @error('transaction_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="description" class="form-label">Descrição <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar Saque</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para Novo Empréstimo -->
        <div class="modal fade" id="modalLoan" tabindex="-1" aria-labelledby="modalLoanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.gestao.loan.cadastrar') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLoanLabel">Registrar Novo Empréstimo</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="amount" class="form-label">Valor (AOA) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                           name="amount" value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="transaction_date" class="form-label">Data da Transação <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('transaction_date') is-invalid @enderror"
                                           name="transaction_date" value="{{ old('transaction_date') }}" required>
                                    @error('transaction_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="interest_rate" class="form-label">Taxa de Juros (%) <span class="text-muted">(Opcional)</span></label>
                                    <input type="number" step="0.01" class="form-control @error('interest_rate') is-invalid @enderror"
                                           name="interest_rate" value="{{ old('interest_rate') }}">
                                    @error('interest_rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="due_date" class="form-label">Data de Vencimento <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                                           name="due_date" value="{{ old('due_date') }}" required>
                                    @error('due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="description" class="form-label">Descrição <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar Empréstimo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Reabrir modal em caso de erro de validação
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                const modalId = '{{ old('transaction_type', 'Saque') === 'Empréstimo' ? '#modalLoan' : '#modalWithdrawal' }}';
                const modal = new bootstrap.Modal(document.querySelector(modalId));
                modal.show();
            });
        @endif
    </script>
@endsection
