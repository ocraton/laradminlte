<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Item: {{ $item->nome }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- errors list -->
    <div class="alert alert-danger alert-dismissible d-none" id="errorsEditList"> <ul> </ul></div>
    <!-- errors list -->
    <!-- save confirm -->
    <div class="alert alert-success alert-dismissible d-none" id="confirmSaveEditList"> </div>
    <!-- save confirm -->
    <!-- form start -->              
    <form method="put" action="{{ route('items.update', $item->id) }}" role="form">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" 
                    class="form-control" id="nome" 
                    value="{{ $item->nome }}"
                    placeholder="Nome" maxlength="100" required>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <div class="form-group">
                <label for="email">Email</label>
                    <input type="email" name="email" value="{{ $item->email }}"
                    class="form-control" id="email" placeholder="Email">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="descrizione">Descrizione</label>
            <input type="text" name="descrizione" value="{{ $item->descrizione }}"
            class="form-control" id="descrizione" placeholder="Descrizione" maxlength="100" required>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="form-group">
                    <label for="indirizzo">indirizzo</label>
                    <input type="text" name="indirizzo" value="{{ $item->indirizzo }}"
                    class="form-control" id="indirizzo" placeholder="indirizzo">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <div class="form-group">
                    <label for="citta">citta</label>
                    <input type="text" name="citta" value="{{ $item->citta }}"
                    class="form-control" id="citta" placeholder="citta">
                </div>
            </div>                                
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="form-group">
                    <label for="provincia">provincia</label>
                    <input type="text" name="provincia" value="{{ $item->provincia }}"
                    class="form-control" id="provincia" placeholder="provincia">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <div class="form-group">
                    <label for="cap">cap</label>
                    <input type="text" name="cap" value="{{ $item->cap }}"
                    class="form-control" id="cap" placeholder="cap">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">                            
                <div class="form-group">
                    <label for="cellulare">cellulare</label>
                    <input type="text" name="cellulare" value="{{ $item->cellulare }}"
                    class="form-control" id="cellulare" placeholder="cellulare">
                </div>
            </div>
            <div class="form-group col-sm-6">                            
                <div class="form-group">
                    <label for="data_creazione">Data</label>
                    <input type="text" name="data_creazione" value="{{ Carbon\Carbon::parse($item->data_creazione)->format('d/m/Y') }}"
                    class="form-control" id="data_creazione" placeholder="Data">
                </div>
                </div>
        </div>
        <button type="button" class="btn btn-success" id="btnSubmit">Salva</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
    </div>
    <!-- /.card-body -->
    </form>
</div>