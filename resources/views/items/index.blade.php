@extends('layouts.master')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Items</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Items</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-success" href="{{ route('items.create') }}"> Create New Item</a> 
                </h3>

                <div class="card-tools">                                    
                    {!! $items->links() !!}                       
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Data</th>
                    <th>Email</th>
                    <th width="280px">Action</th>
                  </tr>
                    @foreach ($items as $item)
                        <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->descrizione }}</td>
                        <td>{{ Carbon\Carbon::parse($item->data_creazione)->format('d/m/Y') }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                        <form action="{{ route('items.destroy',$item->id) }}" method="post">
                        <a class="btn btn-info" href="{{ route('items.show',$item->id) }}" title="show"><i class="nav-icon fa fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}"><i class="nav-icon fa fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="nav-icon fa fa-trash"></i></button>
                        </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection