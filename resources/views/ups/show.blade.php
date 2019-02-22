<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{ $ups->locazione->id }}: {{ $ups->locazione->citta }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<div class="card card-widget widget-user-2">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-warning">
    <!-- /.widget-user-image -->
    <h4 class="widget-user-username">{{ $ups->numero_serie }}</h4>    
  </div>
  <div class="card-footer p-0">
    <ul class="nav flex-column">
      <li class="nav-item">
          <span class="nav-link"><b>stato:</b>  {{ $ups->stato }}   </span>     
      </li>
      <li class="nav-item">
          <span class="nav-link"><b>indirizzo ip:</b>  {{ $ups->ip_address }}   </span>     
      </li>

    </ul>
  </div>  
</div>
<br>
<div class="card-body table-responsive p-0">
    <table class="table table-hover">
        {!! html_entity_decode($ups->alarm_detail) !!}
    </table>  
</div>  

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
</div>
