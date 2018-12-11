<form action="{{ route('locazioni.destroy', $locazione->id) }}" method="post">
<a class="btn btn-info locazioneDetail" href="{{ route('locazioni.show',$locazione->id) }}"  title="dettagli">
    <i class="nav-icon fa fa-eye"></i>
</a>
<a class="btn btn-primary locazioneEdit" href="{{ route('locazioni.edit',$locazione->id) }}" title="modifica">
    <i class="nav-icon fa fa-edit"></i>
</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger btn-delete" title="cancella"><i class="nav-icon fa fa-trash"></i></button>
</form>
