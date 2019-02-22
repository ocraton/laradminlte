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
                                <select class="form-control selectpicker" name="cliente" id="cliente" data-live-search="true">
                                    @foreach($clienti as $cliente)
                                            <option value="{{ $cliente->id }}" data-tokens="{{ $cliente->ragione_sociale }}"
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
                    <div class="row">                        
                        <div class="form-group col-sm-12">
                            <p><button type="button" 
                            class="btn btn-sm btn-info" id="getCoordinates">
                            Ottieni coordinate</button>
                            <div id="messageResponseLonLat"></div>
                            <p>                            
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="form-group col-sm-3">
                            <div class="form-group">                                
                                <input type="lat" name="lat" class="form-control" 
                                id="lat" placeholder="lat" value="{{ old('lat') }}"
                                maxlength="200" required readonly>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="form-group">                                
                                <input type="lon" name="lon" class="form-control" 
                                id="lon" placeholder="lon" value="{{ old('lon') }}"
                                maxlength="200" required readonly>
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

    $('#getCoordinates').on('click', function(e){ 
        addr =  $("#regione option:selected").val()+', '+ $("#provincia option:selected").val()+', '+ $("input[name=citta]").val()+', '+ $("input[name=indirizzo]").val();                                                                                      
        addr_search(addr)
    })

    function addr_search(addr)
    {                
        var xmlhttp = new XMLHttpRequest();
        var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr;
        xmlhttp.onreadystatechange = function()
        {
        if (this.readyState == 4 && this.status == 200)
        {
            var myArr = JSON.parse(this.responseText);
            setLatLongText(myArr);
        }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    function setLatLongText(arr)
    {
        if(arr.length > 0)
        {            
            $("input[name=lat]").val(arr[0].lat)
            $("input[name=lon]").val(arr[0].lon)            
            $('div#messageResponseLonLat').empty();
        }
        else
        {
            $("input[name=lat]").val('')
            $("input[name=lon]").val('')   
            $('div#messageResponseLonLat').html('<span style="color:red">Nessun risultato...riprova.</span>');
        }

    }

    $('#btnSubmit').on('click', function(e){

        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("form").submit();

    })
    
});
</script>
@endsection
