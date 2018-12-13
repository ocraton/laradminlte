@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <style>
   #mapid {
      height: 75vh;
      width: 100%;
    }
   </style>
@endsection

@section('titlepage')
    Starter Page
@endsection

@section('content')


        <div class="row">
          <div class="col-lg-8">
          <div class="card card-primary card-outline">
              <div class="card-body">
                    <h5 class="card-title">Locazioni</h5>              
                    <div id="mapid"></div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Ups</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Ups con fault
                  @if(count($ups) > 0) 
                  <span class="badge badge-danger ">
                    {{ count($ups) }}
                  </span>
                  @else
                  <span class="badge badge-success ">
                    {{ count($ups) }}
                  </span>
                  @endif
                  
                  </h6>
                <ul class="list-group">
                  
                  @if(count($ups) > 0)
                    @foreach($ups as $upsitem)
                    <li class="list-group-item @if($upsitem->stato == 2) list-group-item-danger @elseif($upsitem->stato == 1) list-group-item-warning @else @endif">
                          <p >
                            Numero di serie: 
                            <br>
                            {{ $upsitem->numero_serie }}
                            <br>
                            <a href="">visualizza</a>
                          </p>
                          <p style="font-size: 0.8rem">
                            Locazione <br>
                            Id: {{ $upsitem->locazione->id }} - 
                            regione: {{ $upsitem->locazione->regione }} -
                            provincia: {{ $upsitem->locazione->provincia }} -
                            citta: {{ $upsitem->locazione->citta }} -
                            indirizzo: {{ $upsitem->locazione->indirizzo }}                                                        
                          </p >                        
                    </li>
                    @endforeach
                  @else
                      <div class="alert alert-success">                  
                      
                      <p class="info"><i class="icon fa fa-check"></i> 
                      Non ci sono ups in stato di fault
                      </p>   
                        <input type="hidden" name="stato" id="stato" value="-1">
                    </div>
                  @endif
              

                </ul>
                

              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->



@endsection


@section('scripts')
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
  
<script>
  // center map
  var rm = [41.9027835, 12.4963655];
  // create map
  var map = L.map('mapid').setView(rm, 6);

  // create tileLayer
  L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20
  }).addTo(map);

	var itemPlace = [
    @foreach($locazioni as $locazione)
      [ {{ $locazione->lat }}, {{ $locazione->lon }} , '{{ $locazione->id }}', '{{ $locazione->ups }}' ],
    @endforeach
  ];
  
  for (let i = 0; i < itemPlace.length; i++) {
    add_marker(itemPlace[i][0], itemPlace[i][1], itemPlace[i][2], itemPlace[i][3])
	}

  function add_marker(lat, long, nome, ups) {
    var point = [lat, long];
    // add marker
    var marker = L.marker(point).addTo(map);
    // add popup
    marker.bindPopup('<p><b>'+nome+'</b><br>'+ups+'<br><a href="">modifica</a></p>');
  }

</script>
@endsection