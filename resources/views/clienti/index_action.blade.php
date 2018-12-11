<form action="{{ route('clienti.destroy', $cliente->id) }}" method="post" >
<a class="btn btn-info clienteDetail" href="{{ route('clienti.show', $cliente->id) }}" title="dettagli">
    <i class="nav-icon fa fa-eye"></i>
</a>
<a class="btn btn-primary clienteEdit" href="{{ route('clienti.edit',$cliente->id) }}" title="modifica">
    <i class="nav-icon fa fa-edit"></i>
</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger btn-delete" title="cancella"><i class="nav-icon fa fa-trash"></i></button>
</form>
