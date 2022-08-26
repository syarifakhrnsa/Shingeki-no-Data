@extends('layouts.app')
@section('content')
<div style="width:100%; height:100%;">
    <div id="map" style='width: 100%; height: 100%;'></div>
    <div class="card" 
    style=
        'position: absolute;
        top: 100px;
        left: 40px;
        width: 400px'>
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{$plan_name}}</span>
            </div>
        </div>
        <div class="card-body" style="background-color: #454647">
            <form action="{{route('kmeans', $plan_id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <select class="custom-select px-4" style="height: 47px;" name="duration" >
                        <option value="1" {{$duration == 1 ? 'selected' : ''}}>1 Day</option>
                        <option value="2" {{$duration == 2 ? 'selected' : ''}}>2 Days</option>
                        <option value="3" {{$duration == 3 ? 'selected' : ''}}>3 Days</option>
                        <option value="4" {{$duration == 4 ? 'selected' : ''}}>4 Days</option>
                        <option value="5" {{$duration == 5 ? 'selected' : ''}}>5 Days</option>
                        <option value="6" {{$duration == 6 ? 'selected' : ''}}>6 Days</option>
                        <option value="7" {{$duration == 7 ? 'selected' : ''}}>7 Days</option>
                    </select>
                </div>

                <button type="submit" class="btn active btn-primary btn-block">
                    Generate Plan 
                </button>
            </form>
        </div>
    </div>                                   

    <div class="card"  
        style=
        'position: absolute;
        top: 310px;
        left: 40px;
        width: 400px'>
        <div class="card-header bg-dark text-white">
            <div class=" justify-content-between align-items-center">
                <span>Locations</span>
            </div>
        </div>
        <div class="card-body" style="background-color: #454647; height: 52vh; overflow-y: scroll;">
            <div id="geocoder" class="geocoder"></div>  
            <form action="{{route('addlocation', $plan_id)}}" method="POST" id="locationControl">
                @csrf
                <div class="form-group">
                    <input type="hidden" 
                    id="title"
                    class="form-control dark-input" 
                    name="title"
                    placeholder="Location Name"
                    autocomplete="false"
                    />
                    <input type="hidden" 
                    id="long"
                    name="long"/>
                    <input type="hidden" 
                    id="lat" 
                    name="lat"/>
                </div>
                
                <div class="form-group mb-1">
                    <button type="submit" class="btn active btn-primary btn-block" id="locationButton"> Add Location </button>
                </div>
            </form>
            <div class="d-flex justify-content-between align-items-center mb-8">
                <table class="table mt-3">
                    <tbody>
                        @if(count($locations) == 0)
                            <tr>
                                <td colspan="5" class="text-center">There is no location available</td>
                            </tr>
                        @endif
                        @foreach ($locations as $location)
                        <tr>
                            <td style='color: #dedede'>{{$location->title}}</td>
                            <td>
                                <a onclick="centerMap({{$location->long}}, {{$location->lat}})" class="btn btn-primary" style="">
                                   <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td style="margin: 0px">
                                <a href="{{route('deletelocation', ['plan_id' => $plan_id, 'location_id' => $location->id])}}" 
                                   onclick="return confirm('Are you sure to delete this location?')" class="btn btn-danger">
                                   <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>  
    </div>
    <a href="/plan" class="btn btn-lg btn-danger btn-lg-square" style="position:absolute; right: 30px; bottom:30px;"><i class="fa fa-sign-out"></i></a>
</div>






<style>
    .geocoder {
    z-index: 1;
    width: 100%;
    left: 50%;
    }
    .mapboxgl-ctrl-geocoder {
    min-width: 100%;
    }
        ::-webkit-scrollbar {
    width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    background: #9f9f9f;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: rgb(94, 94, 94);
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: rgb(52, 52, 52);
    }
    #body {overflow: hidden;}
    // Make navbar dark
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script>

    $(document).ready(function(){
        $('#navbar').addClass('bg-dark');
    });

    var latMean = 0.7893;
    var longMean = 113.9213;

    const defaultLocation = [longMean, latMean];
    const coordinateInfo = document.getElementById('info'); 

    mapboxgl.accessToken = "pk.eyJ1Ijoic3lhdHJpYSIsImEiOiJjbDU3Y3M4czAxcmxuM2l0ZDlxejBuYTRuIn0.Sed4ONkUUIRIwzNh7KbOMA";
    let map = new mapboxgl.Map({
        container: "map",
        center: defaultLocation,
        zoom: 4,
        style: "mapbox://styles/mapbox/streets-v11"
    });

    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        marker: {
        color: 'orange'
        },
        mapboxgl: mapboxgl
    });
    
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

    // input geocoder result to variable
    geocoder.on('result', function(ev) {
        const lng = ev.result.geometry.coordinates[0];
        const lat = ev.result.geometry.coordinates[1];
        document.getElementById('title').value = ev.result.place_name;
        document.getElementById('long').value = lng;
        document.getElementById('lat').value = lat;
    });

    
    @if(count($locations) > 0)
        @foreach ($locations as $location)

            const marker{{$location->id}} = new mapboxgl.Marker({
                color: 
                @if($location->label == '1')
                    '#03a8a0'
                @elseif($location->label == '2')
                    '#039c4b'
                @elseif($location->label == '3')
                    '#66f313'
                @elseif($location->label == '4')
                    '#fedf17'
                @elseif($location->label == '5')
                    '#ff0984'
                @elseif($location->label == '6')
                    '#21409a'
                @elseif($location->label == '7')
                    '#e48873'
                @elseif($location->label == '0')
                    '#f16623'
                @else
                    '#80b434'
                @endif
            })
            .setLngLat([{{$location->long}}, {{$location->lat}}])
            .addTo(map);

        @endforeach
    @endif

    function centerMap(lng, lat) {
        map.flyTo({
            center: [lng, lat],
            zoom: 13
        });
    }
</script>

@endsection
