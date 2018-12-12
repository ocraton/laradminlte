<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{ $locazioni->user->ragione_sociale }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<div class="card card-widget widget-user-2">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-warning">
    <!-- /.widget-user-image -->
    <h4 class="widget-user-username">{{ $locazioni->indirizzo }}</h4>
    <h5 class="widget-user-desc">{{ $locazioni->id }}</h5>
  </div>
  <div class="card-footer p-0">
    <ul class="nav flex-column">
      <li class="nav-item">
          <span class="nav-link"><b>indirizzo:</b>  {{ $locazioni->indirizzo }}   </span>     
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>citta:</b>  {{ $locazioni->citta }} </span>       
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>provincia:</b>  {{ $locazioni->provincia }} </span>       
      </li>
    </ul>
  </div>
</div>
<hr>
  <h4>Lista Ups</h4> 
  
    @if(count($locazioni->ups) > 0)
      @foreach($locazioni->ups as $ups)
      <div class="card card-widget widget-user-2">
      <ul class="nav flex-column">
        <li class="nav-item">
            <span class="nav-link"><b>numero di serie:</b>  {{ $ups->numero_serie }}   </span>     
        </li>
        <li class="nav-item">
            <span class="nav-link"><b>indirizzo ip:</b>  {{ $ups->ip_address }}   </span>     
        </li>
        <li class="nav-item">
            <span class="nav-link"><b>Stato:</b>  {{ $ups->stato }}   </span>     
        </li>
      </ul>
      </div>
      @endforeach
    @else
    <p>Nessun ups associato</p>
    @endif      


</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
</div>
