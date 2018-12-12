<form action="{{ route('ups.destroy', $ups->id) }}" method="post" >
<a class="btn btn-info upsDetail" href="{{ route('ups.show',$ups->id) }}"  title="dettagli">
    <i class="nav-icon fa fa-eye"></i>
</a>
<a class="btn btn-primary upsEdit" href="{{ route('ups.edit',$ups->id) }}" title="modifica">
    <i class="nav-icon fa fa-edit"></i>
</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger btn-delete" title="cancella"><i class="nav-icon fa fa-trash"></i></button>
</form>
