<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{ $clienti->id }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<div class="card card-widget widget-user-2">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-warning">
    <!-- /.widget-user-image -->
    <h3 class="widget-user-username">{{ $clienti->ragione_sociale }}</h3>    
  </div>
  <div class="card-footer p-0">
    <ul class="nav flex-column">
    <li class="nav-item">
          <span class="nav-link"><b>Username:</b>  
          {{ $clienti->username }}
          </span>       
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>ID:</b>  
          {{ $clienti->id }}
          </span>       
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>Creato il:</b>  
          {{ Carbon\Carbon::parse($clienti->created_at)->format('d/m/Y') }} 
          </span>       
      </li>
    </ul>
  </div>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
