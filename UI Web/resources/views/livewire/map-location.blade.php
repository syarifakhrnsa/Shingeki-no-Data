<div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">Mapbox</div>
                    <div class="card-body">
                        <div id='map' style='width: 100%; height: 75vh;'></div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">form</div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveLocation">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input wire:model="long" type="text" class="form-control">
                                        @error('long')
                                    <small class="text-danger">{{ $message }}</small>
                                       @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input wire:model="lat" type="text" class="form-control">
                                        @error('lat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label>City</label>
                                <input wire:model="city" type="text" class="form-control">
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 mt-3">
                              <button class="btn btn-dark" type="submit">Submit location</button>
                            </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
{{--  --}}
@push('scripts')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>

    <script>
        document.addEventListener('livewire:load', () => {  })
        const defaultLocation = [106.73872688170701, -6.2927887513008045]

        mapboxgl.accessToken = "{{ env('MAPBOX_KEY') }}";
        var map = new mapboxgl.Map({
            container: 'map',
            center: defaultLocation,
            zoom: 11.5,
            style: "mapbox://styles/mapbox/streets-v11"

        });

        
        map.addControl(new MapboxGeocoder({accessToken: mapboxgl.accessToken,mapboxgl: mapboxgl}))





        const loadLocations = (geoJson) => {
            geoJson.features.forEach((locations) => {
                const {geometry,properties} = locations
                const {iconSize,locationId,city} = properties
                
                let markElement = document.createElement('div')
                markElement.className = 'marker' + locationId
                markElement.id = locationId
                markElement.style.backgroundImage ='url(https://www.clipartmax.com/png/full/114-1148546_base-marker-gps-location-map-map-marker-marker-icon.png)'
                markElement.style.backgroundSize = 'cover'
                markElement.style.width = '30px'
                markElement.style.height = '30px'

                // const popUp = new mapboxgl.Popup({
                //     offset: 25,
                // }).setHTML(city).setMaxWidth('400px')

                markElement.addEventListener('click', (e) => {

                    const locationId = e.toElement.id
                    @this.findLocationById(locationId)
                   
                })

                new mapboxgl.Marker({markElement,draggable: true,color: 'red'})
                    .setLngLat(geometry.coordinates)
                    // .setPopup(popUp)
                    .addTo(map)
                    
                if(city == '1'){
                    var marker = new mapboxgl.Marker({
                        draggable: true,
                        color: 'blue'
                    })
                    marker.setLngLat(geometry.coordinates)
                    marker.addTo(map)}
                
                if(city == '2'){
                    var marker = new mapboxgl.Marker({
                        draggable: true,
                        color: 'orange'
                    })
                    marker.setLngLat(geometry.coordinates)
                    marker.addTo(map)}
                

                    // console.log(locationId);


            })
        }

        loadLocations({!! $geoJson !!})

        window.addEventListener('locationAdded', (e) => {
          loadLocations(JSON.parse(e.detail))
        })
 

        map.on('click', (e) => {
            const longitude = e.lngLat.lng;
            const latitude = e.lngLat.lat;


            @this.long = longitude;
            @this.lat = latitude;

        }) 
   
    
    </script>
@endpush
