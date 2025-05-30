<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="col-form-label" style="color:black">Nome Completo:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name', isset($cliente) ? $cliente->nome : '' ) }}"
                name="name" required >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="phone" class="col-form-label " style="color:black">Contacto:</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', isset($cliente) ? $cliente->numero : '' ) }}"
                id="phone" name="phone" required maxlength="15">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="province" class="col-form-label" style="color:black">Província:</label>
            <input type="text" class="form-control @error('province') is-invalid @enderror"
            value="{{ old('province', isset($cliente) ? $cliente->provincia : '' ) }}"
                id="province" name="province" required>
            @error('province')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12" style="display: flex; justify-content: flex-end;">
        <button type="submit" class="mb-2 btn btn-primary">Salvar</button>
    </div>
</div>

@if($errors->any())
    <script>
        $(document).ready(() => {
            $('#modalCreate').modal('show');
        });
    </script>
@endif
