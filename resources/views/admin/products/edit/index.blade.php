<form action="{{ route('admin.gestao.produto.editar',['id' =>$produto->id]) }}" method="POST">
    @csrf
    @include('_form.admin.produtos.index')
</form>