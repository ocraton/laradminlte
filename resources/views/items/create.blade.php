@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
    Items / create
@endsection

@section('content')
    
    @include ('errors.list')   
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create New Item</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->              
              <form method="post" action="{{ route('items.store') }}" role="form">
              @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                            <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descrizione">Descrizione</label>
                        <input type="text" name="descrizione" class="form-control" id="descrizione" placeholder="Descrizione" maxlength="100" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="indirizzo">indirizzo</label>
                                <input type="text" name="indirizzo" class="form-control" id="indirizzo" placeholder="indirizzo">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="citta">citta</label>
                                <input type="text" name="citta" class="form-control" id="citta" placeholder="citta">
                            </div>
                        </div>                                
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="form-group">
                                <label for="provincia">provincia</label>
                                <input type="text" name="provincia" class="form-control" id="provincia" placeholder="provincia">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="form-group">
                                <label for="cap">cap</label>
                                <input type="text" name="cap" class="form-control" id="cap" placeholder="cap">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">                            
                            <div class="form-group">
                                <label for="cellulare">cellulare</label>
                                <input type="text" name="cellulare" class="form-control" id="cellulare" placeholder="cellulare">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">                            
                            <div class="form-group">
                                <label for="data_creazione">Data</label>
                                <input type="text" name="data_creazione" class="form-control" id="data_creazione" placeholder="Data">
                            </div>
                          </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" id="btnSubmit">Salva</button>
                </div>
              </form>
            </div>

@endsection


@section('scripts')
<script>
$( document ).ready(function() {    
    $("#data_creazione").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
    $("#cap").inputmask("99999");

    $('#btnSubmit').on('click', function(e){

        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("form").submit();

    })
    
});
</script>
@endsection
