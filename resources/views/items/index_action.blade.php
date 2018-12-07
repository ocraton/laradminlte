<form action="{{ route('items.destroy', $item->id) }}" method="post">
<a class="btn btn-info itemDetail" href="{{ route('items.show',$item->id) }}" title="show">
    <i class="nav-icon fa fa-eye"></i>
</a>
<a class="btn btn-primary itemEdit" href="{{ route('items.edit',$item->id) }}">
    <i class="nav-icon fa fa-edit"></i>
</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger btn-delete"><i class="nav-icon fa fa-trash"></i></button>
</form>
