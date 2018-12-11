@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
Locazioni
@endsection

@section('content')

        <div class="row">
          <div class="col-lg-12">
          @include('flash::message')
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-success" href="{{ route('locazioni.create') }}"> Crea nuova Locazione</a> 
                </h3>

                <div class="card-tools">                                    
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover display" id="locazioni-table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Regione</th>                    
                    <th>Citta</th>
                    <th>Provincia</th>
                    <th>Indirizzo</th>
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
<div class="modal fade" id="locazioniModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    var locazioniTable = $('#locazioni-table').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        "order": [[ 0, "desc" ]],
        ajax: "{{ route('locazionidatatable') }}",
        columns: [
            { name: 'id' },
            { name: 'user.ragione_sociale', orderable: false },
            { name: 'regione' },            
            { name: 'citta' },            
            { name: 'provincia' },
            { name: 'indirizzo' },
            { name: 'action', orderable: false, searchable: false }
        ], 
    });

    $('table#locazioni-table').on('click', 'a.locazioneDetail', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#locazioniModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#locazioniModal').modal('show').find('.modal-content').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                                    'Errore, indirizzo sconosciuto </div>');
            }
        });
    });

    $('table#locazioni-table').on('click', 'a.locazioneEdit', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#locazioniModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('error');
            }
        });
    });

    $('#locazioniModal').on('shown.bs.modal', function (event) {
        
        var modal = $(this)
        $('#locazioniModal #btnSubmit').on('click', function(e){
                e.preventDefault();
                $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                var dataForm = {
                    _token: $("#locazioniModal input[name=_token]").val(),
                    cliente: $("#locazioniModal #cliente option:selected").val(),                    
                    indirizzo: $("#locazioniModal input[name=indirizzo]").val(),
                    citta: $("#locazioniModal input[name=citta]").val(),
                    provincia: $("#locazioniModal #provincia option:selected").val(),
                    regione: $("#locazioniModal #regione option:selected").val()
                }
                $.ajax({
                    url: $('#locazioniModal form').attr('action'),
                    type: "put",
                    data: dataForm,
                    success: function(data) {                                            
                        $('#locazioniModal #btnSubmit').html('Salva');
                        $('#locazioniModal div#errorsEditList').removeClass('d-block');
                        $('#locazioniModal div#confirmSaveEditList').addClass('d-block');                        
                        $('#locazioniModal div#confirmSaveEditList').html('<h4>'+data.viewinfo+'</h4>');                    
                        locazioniTable.ajax.reload(null, false);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {                
                        $('#locazioniModal #btnSubmit').html('Salva');
                        $('#locazioniModal div#confirmSaveEditList').removeClass('d-block');
                        $('#locazioniModal div#errorsEditList').addClass('d-block');                    
                        var reqErr = XMLHttpRequest.responseJSON.errors;
                        if(reqErr) {
                            var errli = '';
                            $.each(reqErr, function(key,value) {
                                errli += '<li>'+value+'</li>'
                            }); 
                            $('#locazioniModal div#errorsEditList ul').html(errli); 
                        } else {
                            $('#locazioniModal div#errorsEditList').html(data.viewinfo);
                        }
                    }
                });
        })

    });

    $('body').on('click', '.btn-delete', function (event) {

        event.preventDefault();
        var me = $(this),
        url = me.parent('form').attr('action'),
        title =  me.closest('tr').find('td:eq(0)').text(),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Cancellare locazione con id: ' + title + ' ?',
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
                        locazioniTable.ajax.reload(null, false);
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