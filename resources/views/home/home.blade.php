@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <style>
   #mapid {
      height: 60vh;
      width: 100%;
    }
   </style>
@endsection

@section('titlepage')
    Starter Page
@endsection

@section('content')


        <div class="row">
          <div class="col-lg-6">
          <div class="card card-primary card-outline">
              <div class="card-body">
                    <h5 class="card-title">Items</h5>              
                    <div id="mapid"></div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
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
    @foreach($items as $item)
      [ {{ $item->lat }}, {{ $item->lon }} , '{{ $item->nome }}' ],
    @endforeach
  ];
  
  for (let i = 0; i < itemPlace.length; i++) {
    add_marker(itemPlace[i][0], itemPlace[i][1], itemPlace[i][2])
	}

  function add_marker(lat, long, nome) {
    var point = [lat, long];
    // add marker
    var marker = L.marker(point).addTo(map);
    // add popup
    marker.bindPopup('<p><b>'+nome+'</b><br><a href="">modifica</a></p>');
  }

</script>
@endsection