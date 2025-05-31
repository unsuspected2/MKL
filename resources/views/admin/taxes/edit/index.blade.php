<form action="{{ route('admin.gestao.imposto.editar', ['id' => $imposto->id]) }}" method="POST">
    @csrf
    @include('_form.admin.taxes.index', ['imposto' => $imposto])
</form>
