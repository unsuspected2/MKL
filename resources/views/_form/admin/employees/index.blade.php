<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="col-form-label" style="color:black">Nome Completo:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', isset($funcionario) ? $funcionario->nome : '') }}"
                   name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="col-form-label" style="color:black">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', isset($funcionario) ? $funcionario->email : '') }}"
                   name="email" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone" class="col-form-label" style="color:black">Contacto:</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', isset($funcionario) ? $funcionario->numero : '') }}"
                   name="phone" required maxlength="15">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="department" class="col-form-label" style="color:black">Departamento:</label>
            <select class="form-control @error('department') is-invalid @enderror" name="department" required>
                <option value="" disabled {{ old('department', isset($funcionario) ? $funcionario->departamento : '') == '' ? 'selected' : '' }}>Selecione</option>
                <option value="Marketing" {{ old('department', isset($funcionario) ? $funcionario->departamento : '') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                <option value="Financeiro" {{ old('department', isset($funcionario) ? $funcionario->departamento : '') == 'Financeiro' ? 'selected' : '' }}>Financeiro</option>
                <option value="Jurídico" {{ old('department', isset($funcionario) ? $funcionario->departamento : '') == 'Jurídico' ? 'selected' : '' }}>Jurídico</option>
                <option value="RH" {{ old('department', isset($funcionario) ? $funcionario->departamento : '') == 'RH' ? 'selected' : '' }}>RH</option>
                <option value="Produção" {{ old('department', isset($funcionario) ? $funcionario->departamento : '') == 'Produção' ? 'selected' : '' }}>Produção</option>
            </select>
            @error('department')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="salary" class="col-form-label" style="color:black">Salário:</label>
            <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror"
                   value="{{ old('salary', isset($funcionario) ? $funcionario->salario : '') }}"
                   name="salary" required>
            @error('salary')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="hire_date" class="col-form-label" style="color:black">Data de Contratação:</label>
            <input type="date" class="form-control @error('hire_date') is-invalid @enderror"
                   value="{{ old('hire_date', isset($funcionario) ? $funcionario->data_contratacao : '') }}"
                   name="hire_date" required>
            @error('hire_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="position" class="col-form-label" style="color:black">Cargo:</label>
            <input type="text" class="form-control @error('position') is-invalid @enderror"
                   value="{{ old('position', isset($funcionario) ? $funcionario->cargo : '') }}"
                   name="position" required>
            @error('position')
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
