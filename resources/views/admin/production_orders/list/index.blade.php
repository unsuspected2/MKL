@extends('layouts.admin.body')

@section('title', 'Ordens de Produção')

@section('conteudo')
<div class="container-fluid">
    <center><h3><strong><b>Ordens de Produção</b></strong></h3></center>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="row">
                            <div class="col-6">
                                <div class="row" style="display: flex; justify-content: flex-end">
                                    <div class="col-4 mt-3 mb-1 mr-3">
                                        <form action="">
                                            <input type="search" name="" id="" placeholder="Pesquisar..." class="form-control">
                                        </form>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate" data-whatever="@mdo">
                                            <i class="ti ti-plus fe-16 m-1"></i> Cadastrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table datatables table-hover" id="dataTable-1">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Data de Início</th>
                                        <th>Status</th>
                                        <th>Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['ordens_producao'] as $ordem)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <label class="custom-control-label"></label>
                                                </div>
                                            </td>
                                            <td>{{ $ordem->id }}</td>
                                            <td>{{ $ordem->product->nome ?? 'N/A' }}</td>
                                            <td>{{ $ordem->quantity }}</td>
                                            <td>{{ date('d/m/y', strtotime($ordem->start_date)) }}</td>
                                            <td>{{ $ordem->status }}</td>
                                            <td>
                                                <button class="btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Acção</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEdit-{{ $ordem->id }}">Editar</a>
                                                    <a class="dropdown-item" href="{{ route('admin.gestao.ordem-producao.apagar', ['id' => $ordem->id]) }}">Remover</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modalEdit-{{ $ordem->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                morpheme modifiers
                                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalEditLabel">Editar Ordem de Produção</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.production_orders.edit.index', ['ordem' => $ordem])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($data['ordens_producao']->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-warning text-center"><b>Nenhum registo encontrado!</b></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" tabindex="3" role="dialog" aria-labelledby="modal-tab" aria-hidden="Create">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Cadastrar Ordem de Produção</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.production_orders.create.index')
                </div>
            </div>
        </div>
    </div>

    <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">© MK LDA 2024 <a class="pe-1 text-primary text-decoration-underline">❤️</a></p>
    </div>
</div>

@if (session('ordemProducaoCadastrada'))
<script>
    Swal.fire('Ordem de Produção', '{{ session("ordemProducaoCadastrada") }} com sucesso!', 'success')
</script>
@endif

@if (session('ordemProducaoAtualizada'))
<script>
    Swal.fire('Ordem de Produção', '{{ session("ordemProducaoAtualizada") }} com sucesso!', 'success')
</script>
@endif

@if (session('ordemProducaoRemovida'))
<script>
    Swal.fire('Ordem de Produção', '{{ session("ordemProducaoRemovida") }} com sucesso!', 'success')
</script>
@endif
@endsection
