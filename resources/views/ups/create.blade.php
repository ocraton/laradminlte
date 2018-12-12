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
                                <select class="form-control" name="locazione" id="locazione">
                                    @foreach($locazioni as $locazione)
                                            <option value="{{ $locazione->id }}"
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
                                maxlength="15" required >
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="ip_address">Indirizzo IP</label>
                                <input type="text" name="ip_address" class="form-control" 
                                id="ip_address" placeholder="Indirizzo IP" value="{{ old('ip_address') }}"
                                maxlength="20" required >
                            </div>
                        </div>                                
                    </div>
                    <div class="row">    
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="stato">Stato</label>
                                <br>
                                <div class="form-check form-check">
                                <input class="form-check-input" type="radio" 
                                name="stato" id="stato0" value="0" checked>
                                <label class="form-check-label" for="stato0">nessun fault</label>
                                </div>
                                <div class="form-check form-check">
                                <input class="form-check-input" type="radio" 
                                name="stato" id="stato1" value="1">
                                <label class="form-check-label" for="stato1">fault lieve</label>
                                </div>
                                <div class="form-check form-check">
                                <input class="form-check-input" type="radio" 
                                name="stato" id="stato2" value="2">
                                <label class="form-check-label" for="stato2">fault grave</label>
                                </div>
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

    $("#ip_address").inputmask({ alias: "ip", "placeholder": "_" });
    
    $('#btnSubmit').on('click', function(e){

        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("form").submit();

    })
    
});
</script>
@endsection
