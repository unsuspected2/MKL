<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tax_type" class="col-form-label" style="color:black">Tipo de Imposto:</label>
            <select class="form-control @error('tax_type') is-invalid @enderror" name="tax_type" required>
                <option value="" disabled {{ old('tax_type', isset($imposto) ? $imposto->tax_type : '') == '' ? 'selected' : '' }}>Selecione</option>
                <option value="IVA" {{ old('tax_type', isset($imposto) ? $imposto->tax_type : '') == 'IVA' ? 'selected' : '' }}>IVA</option>
                <option value="Imposto de Renda" {{ old('tax_type', isset($imposto) ? $imposto->tax_type : '') == 'Imposto de Renda' ? 'selected' : '' }}>Imposto de Renda</option>
                <option value="Imposto Municipal" {{ old('tax_type', isset($imposto) ? $imposto->tax_type : '') == 'Imposto Municipal' ? 'selected' : '' }}>Imposto Municipal</option>
            </select>
            @error('tax_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="amount" class="col-form-label" style="color:black">Valor:</label>
            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                   value="{{ old('amount', isset($imposto) ? $imposto->amount : '') }}"
                   name="amount" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="due_date" class="col-form-label" style="color:black">Data de Vencimento:</label>
            <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                   value="{{ old('due_date', isset($imposto) ? $imposto->due_date : '') }}"
                   name="due_date" required>
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status" class="col-form-label" style="color:black">Status:</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                <option value="" disabled {{ old('status', isset($imposto) ? $imposto->status : '') == '' ? 'selected' : '' }}>Selecione</option>
                <option value="Pendente" {{ old('status', isset($imposto) ? $imposto->status : '') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="Pago" {{ old('status', isset($imposto) ? $imposto->status : '') == 'Pago' ? 'selected' : '' }}>Pago</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="sale_id" class="col-form-label" style="color:black">Venda (Opcional):</label>
            <select class="form-control @error('sale_id') is-invalid @enderror" name="sale_id">
                <option value="" {{ old('sale_id', isset($imposto) ? $imposto->sale_id : '') == '' ? 'selected' : '' }}>Nenhuma</option>
                @foreach ($data['vendas'] as $venda)
                    <option value="{{ $venda->id }}" {{ old('sale_id', isset($imposto) ? $imposto->sale_id : '') == $venda->id ? 'selected' : '' }}>Venda #{{ $venda->id }}</option>
                @endforeach
            </select>
            @error('sale_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="notes" class="col-form-label" style="color:black">Notas:</label>
            <textarea class="form-control @error('notes') is-invalid @enderror"
                      name="notes">{{ old('notes', isset($imposto) ? $imposto->notes : '') }}</textarea>
            @error('notes')
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

@if($errors->any())
    <script>
        $(document).ready(() => {
            $('#modalCreate').modal('show');
        });
    </script>
@endif
