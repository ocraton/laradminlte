<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Modifica ups: {{ $ups->numero_serie }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- errors list -->
    <div class="alert alert-danger alert-dismissible d-none" id="errorsEditList"> <ul> </ul></div>
    <!-- errors list -->
    <!-- save confirm -->
    <div class="alert alert-success alert-dismissible d-none" id="confirmSaveEditList"> </div>
    <!-- save confirm -->
    <!-- form start -->              
    <form method="put" action="{{ route('ups.update', $ups->id) }}" role="form">
              @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                                <label for="locazione">Locazione</label>
                                <select class="form-control" name="locazione" id="locazione">
                                    @foreach($locazioni as $locazione)
                                            <option value="{{ $locazione->id }}"
                                            @if ($locazione->id == $ups->locazione_id) {{ 'selected' }} @endif
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
                                 value="{{ $ups->numero_serie }}"
                                maxlength="15" required >
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="form-group">
                                <label for="ip_address">Indirizzo IP</label>
                                <input type="text" name="ip_address" class="form-control" 
                                id="ip_address" placeholder="Indirizzo IP" value="{{ $ups->ip_address }}"
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
                                name="stato" id="stato0" value="0" 
                                @if ($ups->stato == 0) {{ 'checked' }} @endif
                                >
                                <label class="form-check-label" for="stato0">nessun fault</label>
                                </div>
                                <div class="form-check form-check">
                                <input class="form-check-input" type="radio" 
                                name="stato" id="stato1" value="1"
                                @if ($ups->stato == 1) {{ 'checked' }} @endif
                                >
                                <label class="form-check-label" for="stato1">fault lieve</label>
                                </div>
                                <div class="form-check form-check">
                                <input class="form-check-input" type="radio" 
                                name="stato" id="stato2" value="2"
                                @if ($ups->stato == 2) {{ 'checked' }} @endif
                                >
                                <label class="form-check-label" for="stato2">fault grave</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="btnSubmit">Salva</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                </div>
                <!-- /.card-body -->

              </form>
</div>