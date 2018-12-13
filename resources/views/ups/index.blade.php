@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
Ups
@endsection

@section('content')

        <div class="row">
          <div class="col-lg-12">
          @include('flash::message')
          <div class="card">
              <div class="card-header">
                @role('admin')
                <h3 class="card-title">
                    <a class="btn btn-success" href="{{ route('ups.create') }}"> 
                        Crea nuovo Ups
                    </a> 
                </h3>
                @endrole
                <div class="card-tools">                                    
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover display" id="ups-table">
                  <thead>
                  <tr>
                    <th>ID</th> 
                    <th>Locazione</th>                 
                    <th>Numero di Serie</th>
                    <th>IP</th>
                    <th>Stato</th>
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
<div class="modal fade" id="upsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    var upsTable = $('#ups-table').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        "order": [[ 0, "desc" ]],
        ajax: "{{ route('upsdatatable') }}",
        columns: [
            { name: 'id' },
            { name: 'locazione.citta', orderable: false },            
            { name: 'numero_serie' },            
            { name: 'ip_address' },
            { name: 'stato' },
            { name: 'action', orderable: false, searchable: false }
            
        ], 
    });

    $('table#ups-table').on('click', 'a.upsDetail', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#upsModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#upsModal').modal('show').find('.modal-content').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                                    'Errore, indirizzo sconosciuto </div>');
            }
        });
    });

    $('table#ups-table').on('click', 'a.upsEdit', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#upsModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('error');
            }
        });
    });

    $('#upsModal').on('shown.bs.modal', function (event) {
        
        var modal = $(this)
        $('#upsModal #btnSubmit').on('click', function(e){
                e.preventDefault();
                $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                var dataForm = {
                    _token: $("#upsModal input[name=_token]").val(),
                    locazione: $("#upsModal select#locazione option:selected").val(),                    
                    numero_serie: $("#upsModal input[name=numero_serie]").val(),
                    ip_address: $("#upsModal input[name=ip_address]").val(),
                    stato: $("#upsModal input[name=stato]:checked").val()
                }
                $.ajax({
                    url: $('#upsModal form').attr('action'),
                    type: "put",
                    data: dataForm,
                    success: function(data) {                                            
                        $('#upsModal #btnSubmit').html('Salva');
                        $('#upsModal div#errorsEditList').removeClass('d-block');
                        $('#upsModal div#confirmSaveEditList').addClass('d-block');                        
                        $('#upsModal div#confirmSaveEditList').html('<h4>'+data.viewinfo+'</h4>');                    
                        upsTable.ajax.reload(null, false);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {                
                        $('#upsModal #btnSubmit').html('Salva');
                        $('#upsModal div#confirmSaveEditList').removeClass('d-block');
                        $('#upsModal div#errorsEditList').addClass('d-block');                    
                        var reqErr = XMLHttpRequest.responseJSON.errors;
                        if(reqErr) {
                            var errli = '';
                            $.each(reqErr, function(key,value) {
                                errli += '<li>'+value+'</li>'
                            }); 
                            $('#upsModal div#errorsEditList ul').html(errli); 
                        } else {
                            $('#upsModal div#errorsEditList').html(data.viewinfo);
                        }
                    }
                });
        })

    });

    $('body').on('click', '.btn-delete', function (event) {

        event.preventDefault();
        var me = $(this),
        url = me.parent('form').attr('action'),
        title =  me.closest('tr').find('td:eq(2)').text(),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Cancellare ups con numero di serie: ' + title + ' ?',
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
                        upsTable.ajax.reload(null, false);
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