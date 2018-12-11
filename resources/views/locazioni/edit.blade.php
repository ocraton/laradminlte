<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Modifica Locazione: {{ $locazioni->id }} {{ $locazioni->indirizzo }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- errors list -->
    <div class="alert alert-danger alert-dismissible d-none" id="errorsEditList"> <ul> </ul></div>
    <!-- errors list -->
    <!-- save confirm -->
    <div class="alert alert-success alert-dismissible d-none" id="confirmSaveEditList"> </div>
    <!-- save confirm -->
    <!-- form start -->              
    <form method="put" action="{{ route('locazioni.update', $locazioni->id) }}" role="form">
              @csrf
                <div class="card-body">
                                <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="cliente">Cliente</label>
                                <select class="form-control" name="cliente" id="cliente">
                                    @foreach($clienti as $cliente)
                                            <option value="{{ $cliente->id }}"
                                            @if ($locazioni->user_id == $cliente->id) {{ 'selected' }} @endif
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
                                            @if ($locazioni->regione == $key) {{ 'selected' }} @endif
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
                                            @if ($locazioni->provincia == $key) {{ 'selected' }} @endif
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
                                 value="{{ $locazioni->indirizzo }}"
                                maxlength="200" required >
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="citta">citta</label>
                                <input type="text" name="citta" class="form-control" 
                                id="citta" placeholder="citta" value="{{ $locazioni->citta }}"
                                maxlength="200" required >
                            </div>
                        </div>                                
                    </div>
                    <button type="button" class="btn btn-success" id="btnSubmit">Salva</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                </div>
                <!-- /.card-body -->

                   
              </form>
</div>