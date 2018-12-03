<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{ $item->nome }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<div class="card card-widget widget-user-2">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-warning">
    <!-- /.widget-user-image -->
    <h3 class="widget-user-username">{{ $item->nome }}</h3>
    <h5 class="widget-user-desc">{{ $item->email }}</h5>
  </div>
  <div class="card-footer p-0">
    <ul class="nav flex-column">
      <li class="nav-item">
          <span class="nav-link"><b>Data:</b>  {{ Carbon\Carbon::parse($item->data_creazione)->format('d/m/Y') }} </span>       
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>indirizzo:</b>  {{ $item->indirizzo }}   </span>     
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>citta:</b>  {{ $item->citta }} </span>       
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>cap:</b>  {{ $item->cap }} </span>       
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>cellulare:</b>  {{ $item->cellulare }}  </span>      
      </li>
      <li class="nav-item">
        <span class="nav-link"><b>descrizione:</b>  {{ $item->descrizione }}  </span>      
      </li>
    </ul>
  </div>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
