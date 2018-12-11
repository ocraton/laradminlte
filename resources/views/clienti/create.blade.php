@extends('layouts.master')

@section('head')
@endsection

@section('titlepage')
    Clienti / crea nuovo
@endsection

@section('content')
    
    @include ('errors.list')   
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create nuovo Cliente</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->              
              <form method="post" action="{{ route('clienti.store') }}" role="form">
            @csrf
            <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-6">
                        <label for="ragione_sociale">Ragione Sociale</label>
                    <input id="ragione_sociale" placeholder="{{ __('Ragione Sociale') }}" 
                    type="text" class="form-control{{ $errors->has('ragione_sociale') ? ' is-invalid' : '' }}"
                        name="ragione_sociale" value="{{ old('ragione_sociale') }}" maxlength="255" required>

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
                    <input id="username" placeholder="{{ __('Username') }}" type="text" 
                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                        name="username" value="{{ old('username') }}" maxlength="100" required autofocus>

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
                    <input id="password-confirm" placeholder="{{ __('Conferma Password') }}" type="password" class="form-control"
                        name="password_confirmation" required>
    
                </div>
            </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success" id="btnSubmit">{{ __('Salva') }}</button>
            </div>


        </form>

            </div>

@endsection


@section('scripts')
<script>
$( document ).ready(function() {    

/*     
    $('#btnSubmit').on('click', function(e){

        e.preventDefault();
        $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("form").submit();

    }) */
    
});
</script>
@endsection
