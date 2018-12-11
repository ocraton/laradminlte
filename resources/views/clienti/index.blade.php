@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
    Clienti
@endsection

@section('content')

        <div class="row">
          <div class="col-lg-12">
          @include('flash::message')
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-success" href="{{ route('clienti.create') }}"> Crea nuovo Cliente</a> 
                </h3>

                <div class="card-tools">                                    
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover display" id="clienti-table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Ragione Sociale</th>
                    <th>Username</th>
                    <th>Azioni</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->


<!-- modal show / edit -->
<div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>

<!-- modal error -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <div class="modal-content">
    </div>
  </div>
</div>
@endsection


@section('scripts')
<script>
$( document ).ready(function() {

    var clienteTable = $('#clienti-table').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        "order": [[ 0, "desc" ]],
        ajax: "{{ route('clientidatatable') }}",
        columns: [
            { name: 'id' },
            { name: 'ragione_sociale' },
            { name: 'username' },          
            { name: 'action', orderable: false, searchable: false }
        ], 
    });

     $('table#clienti-table').on('click', 'a.clienteDetail', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#clienteModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#errorModal').modal('show').find('.modal-content').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                                    'Errore, indirizzo sconosciuto </div>');
            }
        });
    });

    $('table#clienti-table').on('click', 'a.clienteEdit', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#clienteModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('error');
            }
        });
    });

    $('#clienteModal').on('shown.bs.modal', function (event) {
        
        var modal = $(this)
        $('#clienteModal #btnSubmit').on('click', function(e){
                e.preventDefault();
                $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                var dataForm = {
                    _token: $("#clienteModal input[name=_token]").val(),                    
                    ragione_sociale: $("#clienteModal input[name=ragione_sociale]").val(),
                    username: $("#clienteModal input[name=username]").val(),
                    password: $("#clienteModal input[name=password]").val(),
                    password_confirmation: $("#clienteModal input[name=password_confirmation]").val(),                    
                }
                $.ajax({
                    url: $('#clienteModal form').attr('action'),
                    type: "put",
                    data: dataForm,
                    success: function(data) {                                            
                        $('#clienteModal #btnSubmit').html('Salva');
                        $('#clienteModal div#errorsEditList').removeClass('d-block');
                        $('#clienteModal div#confirmSaveEditList').addClass('d-block');                        
                        $('#clienteModal div#confirmSaveEditList').html('<h4>'+data.viewinfo+'</h4>');                    
                        clienteTable.ajax.reload(null, false);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {                
                        $('#clienteModal #btnSubmit').html('Salva');
                        $('#clienteModal div#confirmSaveEditList').removeClass('d-block');
                        $('#clienteModal div#errorsEditList').addClass('d-block');                    
                        var reqErr = XMLHttpRequest.responseJSON.errors;
                        if(reqErr) {
                            var errli = '';
                            $.each(reqErr, function(key,value) {
                                errli += '<li>'+value+'</li>'
                            }); 
                            $('#clienteModal div#errorsEditList ul').html(errli); 
                        } else {
                            $('#clienteModal div#errorsEditList').html(data.viewinfo);
                        }
                    }
                });
        })

    });

    $('body').on('click', '.btn-delete', function (event) {

        event.preventDefault();
        var me = $(this),
        url = me.parent('form').attr('action'),
        title = me.closest('tr').find('td:eq(1)').text(),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Cancellare: ' + title + ' ?',
            text: 'Non potrai più recuperare i suoi dati!',
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((result) => {              
            if (result) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function (response) {
                        clienteTable.ajax.reload(null, false);
                        swal({
                            icon: 'success',
                            title: 'Cancellato!',
                            text: response.viewinfo
                        });
                    },
                    error: function (xhr) {
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.viewinfo
                        });
                    }
                });
            }
        });
    });    
 
});
</script>
@endsection