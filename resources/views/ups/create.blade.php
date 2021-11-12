@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
    Ups / crea nuovo
@endsection

@section('content')
    
    @include ('errors.list')   
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crea nuovo Ups</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->              
              <form method="post" action="{{ route('ups.store') }}" role="form">
              @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                                <label for="locazione">Locazione</label>
                                <select class="form-control selectpicker" name="locazione" id="locazione" data-live-search="true">                                
                                    @foreach($locazioni as $locazione)
                                            <option value="{{ $locazione->id }}" data-tokens="{{ $locazione->id }}, {{ $locazione->citta }} - {{ $locazione->indirizzo }} | Cliente: {{ $locazione->user->ragione_sociale }}"
                                            @if (old('locazione') == $locazione->id) {{ 'selected' }} @endif
                                            >
                                            {{ $locazione->id }}, {{ $locazione->citta }} - {{ $locazione->indirizzo }}
                                            | Cliente: {{ $locazione->user->ragione_sociale }}
                                            </option>
                                    @endforeach                                 
                                </select>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="numero_serie">Numero di serie</label>
                                <input type="text" name="numero_serie"
                                 class="form-control" id="numero_serie" placeholder="Numero di serie" 
                                 value="{{ old('numero_serie') }}"
                                maxlength="100" required >
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="ip_address">Indirizzo IP</label>
                                <input type="text" name="ip_address" class="form-control" 
                                id="ip_address" placeholder="Indirizzo IP" value="{{ old('ip_address') }}"
                                maxlength="100" required >
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="modello">Modello</label>
                                <input type="text" name="modello" class="form-control" 
                                id="modello" placeholder="Modello" value="{{ old('modello') }}"
                                maxlength="50" >
                            </div>
                        </div>                                 
                    </div>
                    <div class="row">    
                        <div class="form-group col-sm-6">
                        <div class="alert alert-info">                  
                  
                  <p class="info"><i class="icon fa fa-info"></i> Verrà inizializzato con lo stato di default</p>   
                    <input type="hidden" name="stato" id="stato" value="-1">
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

    // $("#ip_address").inputmask({ alias: "ip", "placeholder": "_" });
    
    $('#btnSubmit').on('click', function(e){

        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("form").submit();

    })
    
});
</script>
@endsection
