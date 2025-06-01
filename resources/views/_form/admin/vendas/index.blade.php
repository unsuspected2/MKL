<div class="row" style="margin-bottom: 12px">
    <div class="col-md-6">
        <div class="form-group">
            <label for="id_cliente" class="col-form-label" style="color:black">Nome do Cliente:</label>
            <select class="form-control @error('id_cliente') is-invalid @enderror" id="id_cliente" name="id_cliente" required>
                <option value="">Selecione um cliente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ old('id_cliente', isset($sale) ? $sale->id_cliente : '') == $client->id ? 'selected' : '' }}>
                        {{ $client->nome }}
                    </option>
                @endforeach
            </select>
            @error('id_cliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="id_product" class="col-form-label" style="color:black">Nome do Produto:</label>
            <select class="form-control @error('id_product') is-invalid @enderror" id="id_product" name="id_product" required>
                <option value="">Selecione um produto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('id_product', isset($sale) ? $sale->id_product : '') == $product->id ? 'selected' : '' }}
                            data-preco="{{ $product->preco }}">
                        {{ $product->nome }} (Preço: {{ number_format($product->preco, 2, ',', '.') }})
                    </option>
                @endforeach
            </select>
            @error('id_product')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="quantidade" class="col-form-label" style="color:black">Quantidade Comprada:</label>
            <input type="number" class="form-control @error('quantidade') is-invalid @enderror"
                   value="{{ old('quantidade', isset($sale) ? $sale->quantidade : '') }}"
                   id="quantidade" name="quantidade" min="1" required>
            @error('quantidade')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="data_venda" class="col-form-label" style="color:black">Data da Venda:</label>
            <input type="date" class="form-control @error('data_venda') is-invalid @enderror"
                   value="{{ old('data_venda', isset($sale) ? $sale->data_venda : '') }}"
                   id="data_venda" name="data_venda" required>
            @error('data_venda')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="total" class="col-form-label" style="color:black">Total:</label>
            <input type="text" class="form-control @error('total') is-invalid @enderror"
                   value="{{ old('total', isset($sale) ? number_format($sale->total, 2, ',', '.') : '') }}"
                   id="total" name="total" readonly>
            @error('total')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12" style="display: flex; justify-content: flex-end;">
        <button type="submit" class="btn mb-2 btn-primary">Salvar</button>
    </div>
</div>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const produtoSelect = document.getElementById('id_product');
            const quantidadeInput = document.getElementById('quantidade');
            const totalInput = document.getElementById('total');

            function calcularTotal() {
                const preco = produtoSelect.options[produtoSelect.selectedIndex]?.dataset.preco || 0;
                const quantidade = quantidadeInput.value || 0;
                const total = parseFloat(preco) * parseInt(quantidade);
                totalInput.value = total.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
            }

            produtoSelect.addEventListener('change', calcularTotal);
            quantidadeInput.addEventListener('input', calcularTotal);

            // Calcular total inicial se estiver editando
            calcularTotal();
        });
    </script>
@endsection
