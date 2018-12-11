@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
    Locazioni / crea nuova
@endsection

@section('content')
    
    @include ('errors.list')   
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crea nuova Locazione</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->              
              <form method="post" action="{{ route('locazioni.store') }}" role="form">
              @csrf
                <div class="card-body">
                                <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="cliente">Cliente</label>
                                <select class="form-control" name="cliente" id="cliente">
                                    @foreach($clienti as $cliente)
                                            <option value="{{ $cliente->id }}"
                                            @if (old('cliente') == $cliente->id) {{ 'selected' }} @endif
                                            >
                                            {{ $cliente->ragione_sociale }}
                                            </option>
                                    @endforeach                                 
                                </select>
                            </div>
                        </div> 
                    </div>
                <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="regione">Regione</label>
                                <select class="form-control" name="regione" id="regione">
                                    @foreach(getRegioni() as $key => $v)
                                            <option value="{{ $key }}"
                                            @if (old('regione') == $key) {{ 'selected' }} @endif
                                            >{{ $v }}</option>
                                    @endforeach                                 
                                </select>
                            </div>
                        </div>                
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="provincia">provincia</label>
                                <select class="form-control" name="provincia" id="provincia">
                                    @foreach(getProvince() as $key)
                                            <option value="{{ $key }}"
                                            @if (old('provincia') == $key) {{ 'selected' }} @endif
                                            >{{ $key }}</option>
                                    @endforeach                                 
                                </select>
                            </div>
                        </div>
                    </div>                
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="indirizzo">indirizzo</label>
                                <input type="text" name="indirizzo"
                                 class="form-control" id="indirizzo" placeholder="indirizzo" 
                                 value="{{ old('indirizzo') }}"
                                maxlength="200" required >
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="citta">citta</label>
                                <input type="text" name="citta" class="form-control" 
                                id="citta" placeholder="citta" value="{{ old('citta') }}"
                                maxlength="200" required >
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

    $('#btnSubmit').on('click', function(e){

        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("form").submit();

    })
    
});
</script>
@endsection
