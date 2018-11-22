@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
          <div class="card card-primary card-outline">
              <div class="card-body">
                    <h5 class="card-title">Items</h5>              
                    <div id="map" style="width: 100%; height: 100%;"></div>
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


@section('scripts')
<script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
<script>

window.onload = () => {
  initialize_map(); 
  add_map_point(41.924252, 12.652587);
  add_map_point(43.124252, 13.652587);
} 

/* OSM & OL example code provided by https://mediarealm.com.au/ */
  var map;
  var mapLat = 41.924252;
  var mapLng = 12.652587;
  var mapDefaultZoom = 10;
 
 function initialize_map() {
    map = new ol.Map({
    target: "map",
    layers: [
    new ol.layer.Tile({
    source: new ol.source.OSM({
    url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png"
    })
    })
    ],
    view: new ol.View({
    center: ol.proj.fromLonLat([mapLng, mapLat]),
    zoom: mapDefaultZoom
    })
    });
 }

 function add_map_point(lat, lng) {
    var vectorLayer = new ol.layer.Vector({
    source:new ol.source.Vector({
    features: [new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
    })]
    }),
    style: new ol.style.Style({
    image: new ol.style.Icon({
    anchor: [0.5, 0.5],
    anchorXUnits: "fraction",
    anchorYUnits: "fraction",
    src: "https://upload.wikimedia.org/wikipedia/commons/e/ec/RedDot.svg"
    })
    })
    });
    map.addLayer(vectorLayer);
 }

</script>
@endsection