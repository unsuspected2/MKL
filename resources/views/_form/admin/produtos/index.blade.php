<div class="row" style="margin-bottom: 12px">
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="col-form-label" style="color:black">Nome do Produto:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
             value="{{ old('name', isset($produto) ? $produto->nome : '' ) }}"  
                name="name" required >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="inform" class="col-form-label " style="color:black">Descrição:</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
            value="{{ old('inform', isset($produto) ? $produto->descricao : '' ) }}"  
                id="phone" name="inform" required > 
            @error('inform')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="price" class="col-form-label" style="color:black">Preço:</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" 
            value=""  
                id="price" name="price" required  placeholder="Ex.: 1999.89" >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="quantity" class="col-form-label" style="color:black">Quantidade Disponível:</label>
            <input type="text" class="form-control @error('quantity') is-invalid @enderror" 
            value="{{ old('quantity', isset($produto) ? $produto->quantidade_disponivel : '' ) }}"  
                id="quantity" name="quantity" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <label for="category" class="col-form-label" style="color:black">Categoria:</label>
        <input type="text" class="form-control @error('category') is-invalid @enderror" 
        value="{{ old('category', isset($produto) ? $produto->categoria : '' ) }}"  
            id="category" name="category" required>
        @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="supplier_name" class="col-form-label" style="color:black">Nome do Fornecedor:</label>
        <select class="form-control @error('supplier_name') is-invalid @enderror" 
            id="supplier_name" name="supplier_name" required>
            <option value="" >Selecione um fornecedor</option>
            @foreach($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id }}" {{  (old('supplier_name') == $fornecedor->id || (isset($produto) && $produto->nome_fornecedor == $fornecedor->id)) ? 'selected' : '' }}    required >
                    {{ $fornecedor->nome }}
                </option>
            @endforeach
        </select>
        @error('supplier_name')
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceInput = document.getElementById('price');
    
        priceInput.addEventListener('input', function (e) {
            // Remove tudo que não é dígito ou vírgula
            let value = e.target.value.replace(/[^0-9,]/g, '');
    
            // Se houver uma vírgula, substitui para formatação correta
            if (value.includes(',')) {
                value = value.replace(',', '.'); // Converte a vírgula em ponto para facilitar a manipulação
            }
    
            // Formata o valor como número
            const numericValue = parseFloat(value.replace('.', ','));
    
            if (!isNaN(numericValue)) {
                // Formata o valor para exibição
                e.target.value = numericValue.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 1,
                }).replace(',', '.');
            }
        });
    });
    </script>

@if($errors->any())
    <script>
        $(document).ready(() => {
            $('#modalCreate').modal('show');
        });
    </script>
@endif