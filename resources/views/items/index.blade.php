@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
    Items
@endsection

@section('content')

        <div class="row">
          <div class="col-lg-12">
          @include('flash::message')
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-success" href="{{ route('items.create') }}"> Create New Item</a> 
                </h3>

                <div class="card-tools">                                    
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover display" id="item-table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Data</th>
                    <th>Email</th>
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
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    var itemTable = $('#item-table').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        "order": [[ 0, "desc" ]],
        ajax: "{{ route('itemdatatable') }}",
        columns: [
            { name: 'id' },
            { name: 'nome' },
            { name: 'descrizione' },
            { name: 'data_creazione' },
            { name: 'email' },
            { name: 'action', orderable: false, searchable: false }
        ], 
    });

    $('table#item-table').on('click', 'a.itemDetail', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#itemModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#errorModal').modal('show').find('.modal-content').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                                    'Errore, indirizzo sconosciuto </div>');
            }
        });
    });

    $('table#item-table').on('click', 'a.itemEdit', function (e) {  
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "get",
            success: function(data) {
                $('#itemModal').modal('show').find('.modal-content').html(data.viewinfo);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('error');
            }
        });
    });

    $('#itemModal').on('shown.bs.modal', function (event) {
        
        var modal = $(this)
        $("#itemModal #data_creazione").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
        $("#itemModal #cap").inputmask("99999");
        $('#itemModal #btnSubmit').on('click', function(e){
                e.preventDefault();
                $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                var dataForm = {
                    _token: $("#itemModal input[name=_token]").val(),
                    nome: $("#itemModal input[name=nome]").val(),
                    email: $("#itemModal input[name=email]").val(),
                    descrizione: $("#itemModal input[name=descrizione]").val(),
                    indirizzo: $("#itemModal input[name=indirizzo]").val(),
                    citta: $("#itemModal input[name=citta]").val(),
                    provincia: $("#itemModal input[name=provincia]").val(),
                    cap: $("#itemModal input[name=cap]").val(),
                    cellulare: $("#itemModal input[name=cellulare]").val(),
                    data_creazione: $("#itemModal input[name=data_creazione]").val()
                }
                $.ajax({
                    url: $('#itemModal form').attr('action'),
                    type: "put",
                    data: dataForm,
                    success: function(data) {                                            
                        $('#itemModal #btnSubmit').html('Salva');
                        $('#itemModal div#errorsEditList').removeClass('d-block');
                        $('#itemModal div#confirmSaveEditList').addClass('d-block');                        
                        $('#itemModal div#confirmSaveEditList').html('<h4>'+data.viewinfo+'</h4>');                    
                        itemTable.ajax.reload(null, false);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {                
                        $('#itemModal #btnSubmit').html('Salva');
                        $('#itemModal div#confirmSaveEditList').removeClass('d-block');
                        $('#itemModal div#errorsEditList').addClass('d-block');                    
                        var reqErr = XMLHttpRequest.responseJSON.errors;
                        if(reqErr) {
                            var errli = '';
                            $.each(reqErr, function(key,value) {
                                errli += '<li>'+value+'</li>'
                            }); 
                            $('#itemModal div#errorsEditList ul').html(errli); 
                        } else {
                            $('#itemModal div#errorsEditList').html(data.viewinfo);
                        }
                    }
                });
        })

    });

    $('body').on('click', '.btn-delete', function (event) {

        event.preventDefault();
        var me = $(this),
        url = me.parent('form').attr('action'),
        title = 'Questo Item',
        csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Are you sure want to delete ' + title + ' ?',
            text: 'You won\'t be able to revert this!',
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
                        itemTable.ajax.reload(null, false);
                        swal({
                            icon: 'success',
                            title: 'Success!',
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