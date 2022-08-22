@extends('layouts.app')
@section('content')
<div>
    <div id="map" style='width: 100%; height: 90vh;' ></div>
    <div class="card" 
    style=
        'position: absolute;
        top: 80px;
        left: 40px;
        width: 400px'>
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <span>Locations</span>
                @if($isEdit)
                <button 
                class="btn btn-success active">New Location</button>
                @endif
            </div>
        </div>
        <div class="card-body" style="background-color: #454647">
            <form action="{{route('addlocation', $plan_id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="text-white">Location Name</label>
                    <input type="text" 
                    id="title"
                    class="form-control dark-input" 
                    name="title"
                    placeholder="Location Name"
                    autocomplete="false"
                    />
                    <input type="hidden" 
                    id="long"
                    style="display: none;" 
                    name="long"/>
                    <input type="text" 
                    id="lat" 
                    style=" display: none;"
                    name="lat"/>
                </div>
        
                <div class="form-group">
                    <button type="submit" 
                    class="btn active btn-{{$isEdit ? 'success text-white' : 'primary'}} btn-block"

                    >
                    {{$isEdit ? 'Update Location' : 'Add Location'}} 
                    </button>
                    @if($isEdit)
                    <button type="button" class="btn btn-danger active btn-block">Delete Location</button>
                    @endif 
                </div>
            </form>
            <form action="{{route('kmeans', $plan_id)}}" method="POST">
                @csrf
                <div class="mb-3 mb-md-0">
                    <select class="custom-select px-4" style="height: 47px;" name="duration" >
                        <option selected>Duration</option>
                        <option value="1" {{$duration == 1 ? 'selected' : ''}}>1 Day</option>
                        <option value="2" {{$duration == 2 ? 'selected' : ''}}>2 Days</option>
                        <option value="3" {{$duration == 3 ? 'selected' : ''}}>3 Days</option>
                        <option value="4" {{$duration == 4 ? 'selected' : ''}}>4 Days</option>
                        <option value="5" {{$duration == 5 ? 'selected' : ''}}>5 Days</option>
                        <option value="6" {{$duration == 6 ? 'selected' : ''}}>6 Days</option>
                        <option value="7" {{$duration == 7 ? 'selected' : ''}}>7 Days</option>
                    </select>
                </div>

            <div class="form-group ">
                <button type="submit" 
                class="btn active btn-{{$isEdit ? 'success text-white' : 'primary'}} btn-block py-8 mt-8 pt-8"
                >
                Make a Plan
                </button>
            </div>
            </form>
        </div>            

        <div class="card"  
        style=
        'position: absolute;
        top: 450px;
        right: 0px;
        width: 400px'>
            <div class="card-header bg-dark text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Label</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($locations) == 0)
                                <tr>
                                    <td colspan="5" class="text-center">There is no location available</td>
                                </tr>
                            @endif
                            @foreach ($locations as $location)
                            <tr>
                                <td>{{$location->title}}</td>
                                <td>{{$location->long}}</td>
                                <td>{{$location->lat}}</td>
                                <td>{{$location->label}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>  
</div>






<div id="info" style="display:none"></div>

<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    // Initialize the map
    const defaultLocation = [106.697, -6.313];
    const coordinateInfo = document.getElementById('info'); 

    mapboxgl.accessToken = "pk.eyJ1Ijoic3lhdHJpYSIsImEiOiJjbDU3Y3M4czAxcmxuM2l0ZDlxejBuYTRuIn0.Sed4ONkUUIRIwzNh7KbOMA";
    let map = new mapboxgl.Map({
        container: "map",
        center: defaultLocation,
        zoom: 11.15,
        style: "mapbox://styles/mapbox/streets-v11"
    });


    // Generate marker
    @foreach ($locations as $location)
        const marker{{$location->id}} = new mapboxgl.Marker({
            draggable: true,
            color: 
            @if($location->label == '1')
                '#ff0000'
            @elseif($location->label == '2')
                '#00ff00'
            @elseif($location->label == '3')
                '#ff00ff'
            @elseif($location->label == '4')
                '#ffff00'
            @elseif($location->label == '5')
                '#ff00ff'
            @elseif($location->label == '6')
                '#00ffff'
            @elseif($location->label == '7')
                '#000000'
            @elseif($location->label == '0')
                '#0000ff'
            @else
                '#ffffff'
            @endif
        })
        .setLngLat([{{$location->long}}, {{$location->lat}}])
        .addTo(map);
    @endforeach



    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        marker: {
        color: 'orange'
        },
        mapboxgl: mapboxgl
    });
    
    map.addControl(geocoder);

    // input geocoder result to variable
    geocoder.on('result', function(ev) {
        const lng = ev.result.geometry.coordinates[0];
        const lat = ev.result.geometry.coordinates[1];
        document.getElementById('title').value = ev.result.place_name;
        document.getElementById('long').value = lng;
        document.getElementById('lat').value = lat;
    });

    // Submit form


    

</script>

@endsection
