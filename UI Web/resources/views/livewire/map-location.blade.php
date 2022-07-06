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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input wire:model="long" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input wire:model="lat" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@push('scripts')
    <script>
        // document.addEventListener('livewire:load', () => {})
        const defaultLocation = [106.99429022945975, -6.2350495840466635]

        mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
        var map = new mapboxgl.Map({
            container: 'map',
            center: defaultLocation,
            zoom: 11.5,

        });

        map.setStyle('mapbox://styles/mapbox/streets-v11')

        map.addControl(new mapboxgl.NavigationControl())

        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
            })
        );

        map.on('click', (e) => {
            const longitude = e.lngLat.lng;
            const latitude = e.lngLat.lat;
            // make const to get the city
            // const city = getCity(latitude, longitude);



            @this.long = longitude;
            @this.lat = latitude;

            // console.log(city);
        })
    </script>
@endpush
