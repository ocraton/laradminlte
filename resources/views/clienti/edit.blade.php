<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Modifica Cliente: {{ $clienti->username }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- errors list -->
    <div class="alert alert-danger alert-dismissible d-none" id="errorsEditList"> <ul> </ul></div>
    <!-- errors list -->
    <!-- save confirm -->
    <div class="alert alert-success alert-dismissible d-none" id="confirmSaveEditList"> </div>
    <!-- save confirm -->
    <!-- form start -->              
    <form method="put" action="{{ route('clienti.update', $clienti->id) }}" role="form">
    @csrf
    <div class="card-body">
    <div class="row">
                <div class="form-group col-sm-6">
                        <label for="ragione_sociale">Ragione Sociale</label>
                    <input id="ragione_sociale" placeholder="{{ __('Ragione Sociale') }}" 
                    type="text" class="form-control{{ $errors->has('ragione_sociale') ? ' is-invalid' : '' }}"
                        name="ragione_sociale" value="{{ $clienti->ragione_sociale }}" maxlength="255" required>

                    @if ($errors->has('ragione_sociale'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ragione_sociale') }}</strong>
                    </span>
                    @endif
                    
                </div>
            </div>
    <div class="row">
                <div class="form-group col-sm-6">
                        <label for="username">Username</label>
                    <input id="username" placeholder="{{ __('Username') }}" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                        name="username" value="{{ $clienti->username }}" maxlength="100" required autofocus>

                    @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                    
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                <label for="password">Password</label>
                    <input id="password" placeholder="{{ __('Password') }}" type="password"                    
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" maxlength="100" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                <label for="password-confirm">Conferma Password</label>
                    <input id="password-confirm" placeholder="{{ __('Conferma Password') }}" 
                    type="password" class="form-control"
                        name="password_confirmation" required>
    
                </div>
            </div>
           
        <button type="button" class="btn btn-success" id="btnSubmit">Salva</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
    </div>
    <!-- /.card-body -->
    </form>
</div>