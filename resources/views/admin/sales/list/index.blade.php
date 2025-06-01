@extends('layouts.admin.body')

@section('title', 'Vendas')

@section('conteudo')
<div class="container-fluid">
    <center><h3><strong><b>Vendas</b></strong></h3></center>

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
                                            <input type="search" name="search" placeholder="Pesquisar..." class="form-control">
                                        </form>
                                    </div>
                                    <div class="col-6 mt-3 mb-1 ml-5">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                                            <i class="ti ti-report-money fe-16 m-1"></i> Cadastrar
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
                                        <th>Nome do Cliente</th>
                                        <th>Nome do Produto</th>
                                        <th>Preço do Produto</th>
                                        <th>Quantidade Comprada</th>
                                        <th>Total</th>
                                        <th>Data</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <label class="custom-control-label"></label>
                                                </div>
                                            </td>
                                            <td>{{ $sale->id }}</td>
                                            <td>{{ $sale->client->nome }}</td>
                                            <td>{{ $sale->product->nome }}</td>
                                            <td>{{ number_format($sale->product->preco, 2, ',', '.') }}</td>
                                            <td>{{ $sale->quantidade }}</td>
                                            <td>{{ number_format($sale->total, 2, ',', '.') }}</td>
                                            <td>{{ date('d/m/Y', strtotime($sale->created_at)) }}</td>
                                            <td>
                                                

                                                <button class="btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Ação</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.gestao.venda.editar', ['id' => $sale->id]) }}">Editar</a>
                                                    <a class="dropdown-item" href="{{ route('admin.gestao.venda.apagar', ['id' => $sale->id]) }}">Remover</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($sales->isEmpty())
                                        <tr>
                                            <td colspan="9" class="text-warning text-center"><b>Nenhum registro encontrado!</b></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Cadastrar Venda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.sales.create.index')
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">© MK LDA 2025 <a class="pe-1 text-primary text-decoration-underline">❤️</a></p>
</div>

@if (session('vendaCadastrado'))
    <script>
        Swal.fire(
            'Venda',
            '{{ session("vendaCadastrado") }}',
            'success'
        )
    </script>
@endif

@if (session('vendaAtualizado'))
    <script>
        Swal.fire(
            'Venda',
            '{{ session("vendaAtualizado") }}',
            'success'
        )
    </script>
@endif

@if (session('vendaRemovido'))
    <script>
        Swal.fire(
            'Venda',
            '{{ session("vendaRemovido") }}',
            'success'
        )
    </script>
@endif
@endsection
