<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{ $ups->locazione->id }}: {{ $ups->locazione->citta }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">

<div class="card-body table-responsive p-0">
    <table class="table table-hover">
        {!! html_entity_decode($ups->info) !!}
    </table>
</div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
</div>
