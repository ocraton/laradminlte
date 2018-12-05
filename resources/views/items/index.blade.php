@extends('layouts.master')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
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
                descrizione: $("#itemModal input[name=descrizione]").val()
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


});
</script>
@endsection