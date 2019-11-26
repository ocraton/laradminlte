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
    Dashboard
@endsection

@section('content')

        <div class="row">
          <div class="col-lg-8">
          <div class="card card-primary card-outline">
              <div class="card-body">
                    <h5 class="card-title">Locazioni</h5>
                    <h6>Stato 0  <span style="height: 1rem; width: 1rem; background-color: #75d35b; border-radius: 50%; display: inline-block;"></span> = nessun fault
                    | Stato 1 <span style="height: 1rem; width: 1rem; background-color: #ffd400; border-radius: 50%; display: inline-block;"></span> = fault lieve
                    | Stato 2 <span style="height: 1rem; width: 1rem; background-color: #e54b4b; border-radius: 50%; display: inline-block;"></span> = fault grave</h6>
                    <div id="mapid"></div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4">
            <div class="card @if(count($ups) > 0) card-danger @else card-success @endif card-outline">
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
                  <br> <br>
                <ul class="list-group" id="listupsfault">

                  @if(count($ups) > 0)
                    @foreach($ups as $upsitem)
                    <li class="list-group-item @if($upsitem->stato == 2) list-group-item-danger @elseif($upsitem->stato == 1) list-group-item-warning @else @endif">
                          <p >
                            Numero di serie:
                            <br>
                            {{ $upsitem->numero_serie }}
                            @if($upsitem->alarm_detail != '')
                            <table class="table">
                            {!! preg_replace( "/\r\n|\r|\n/", " ", html_entity_decode($upsitem->alarm_detail)) !!}
                            </table>
                            @endif
                            <br>
                            <a href="http://{{ $upsitem->ip_address }}" target="_blank" class="btn btn-outline-primary btn-xs">vai <i class="fas fa-angle-right"></i></a>
                             |
                            <a href="{{ route('ups.getinfo', $upsitem->id) }}" class="btn btn-outline-info btn-xs upsInfoDetail">info <i class="icon fa fa-info"></i></a>
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

<!-- modal show / edit -->
<div class="modal fade" id="infoUpsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>


@endsection


@section('scripts')
<script>
$( document ).ready(function() {
      $('ul#listupsfault').on('click', 'a.upsInfoDetail', function (e) {
          e.preventDefault();
          $.ajax({
              url: $(this).attr('href'),
              type: "get",
              success: function(data) {
                  $('#infoUpsModal').modal('show').find('.modal-content').html(data.viewinfo);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                  $('#infoUpsModal').modal('show').find('.modal-content').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                                                               'Errore, indirizzo sconosciuto </div>');
              }
          });
      });
});
</script>
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
      [ {{ $locazione->lat }}, {{ $locazione->lon }} , '{{ $locazione->user->ragione_sociale }}',
      '{{ $locazione->id }}', '{{ $locazione->citta }}, {{ preg_replace( "/\r\n|\r|\n/", " ", $locazione->indirizzo ) }}',
        [
          @foreach($locazione->ups as $ups)
            {'id': '{{ $ups->id }}', 'numero_serie': '{{ $ups->numero_serie }}',
            'stato': "{{ $ups->stato }}", 'ip_address': '{{ $ups->ip_address }}',
            'alarm_detail': '{!! preg_replace( "/\r\n|\r|\n/", " ", html_entity_decode($ups->alarm_detail)) !!}'  },
          @endforeach
        ]
      ],
    @endforeach
  ];

  for (let i = 0; i < itemPlace.length; i++) {
    add_marker(itemPlace[i][0], itemPlace[i][1], itemPlace[i][2], itemPlace[i][3],
                itemPlace[i][4], itemPlace[i][5])
	}

  function add_marker(lat, long, cliente, locazioneId, indirizzo, ups) {

    const coloreStatoDefault = '#75d35b'
    const coloreStato0 = '#75d35b'
    const coloreStato1 = '#ffd400'
    const coloreStato2 = '#e54b4b'

    upsHtml = '';
    let countRosso = countGiallo = 0;
    for(let i=0;i<ups.length;i++) {
      if(ups[i].stato == 2) {countRosso++; coloreTestoUps = coloreStato2};
      if(ups[i].stato == 1) {countGiallo++; coloreTestoUps = coloreStato1};
      if(ups[i].stato != 1 && ups[i].stato != 2) {coloreTestoUps = '#424242'};
      upsHtml += '<span style="color:'+coloreTestoUps+'">Numero Serie: '+
      ups[i].numero_serie+' stato: '+ups[i].stato +
      '<br><table style="width:100%">'+ups[i].alarm_detail+'</table>'+
      '<br><a href="http://'+ups[i].ip_address+'" target="_blank">vai</a></span> <hr>';
    }

    let coloreMarker = coloreStatoDefault;

    if(countRosso > 0) { coloreMarker = coloreStato2 }
    if(countGiallo > 0 && countRosso == 0) { coloreMarker = coloreStato1 }

    const markerHtmlStyles = `
      background-color: ${coloreMarker};
      width: 1.5rem;
      height: 1.5rem;
      display: block;
      left: -1.5rem;
      top: -1.5rem;
      position: relative;
      border-radius: 3rem 3rem 0;
      transform: rotate(45deg);
      border: 1px solid #FFFFFF`

    const cIcon = L.divIcon({
      className: "my-custom-pin",
      iconAnchor: [0, 24],
      labelAnchor: [-6, 0],
      popupAnchor: [-10, -36],
      html: `<span style="${markerHtmlStyles}" />`
    })

    var point = [lat, long];
    // add marker
    var marker = L.marker(point, {icon: cIcon}).addTo(map);
    // add popup
    marker.bindPopup('<p><b><span style="font-size: 1rem">'+cliente+'</span> <br> id:'+locazioneId+' - '+indirizzo+'</b><br><br>'+upsHtml+'</p>');
  }


  window.Echo.channel('upsstatus')
    .listen('UpsStatusUpdated', (e) => {
        // console.log(e);
        refreshAfterUpsStatusChgange();
    });

    function refreshAfterUpsStatusChgange() {
      location.reload(true);
    }


</script>
@endsection
