
<div>
    <div class="row ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">Maps</div>
                <div wire:ignore id="map" style='width: 100%; height: 80vh;' ></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                   <div class="d-flex justify-content-between align-items-center">
                       <span>Locations</span>
                       @if($isEdit)
                       <button wire:click="clearForm" class="btn btn-success active">New Location</button>
                       @endif
                   </div>
                </div>
                <div class="card-body" style="background-color: #454647">
                    <form @if($isEdit)
                        wire:submit.prevent="update"
                        @else
                        wire:submit.prevent="store"
                        @endif 
                    >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">Longtitude</label>
                                    <input type="text" wire:model="long" class="form-control dark-input" 
                                        {{$isEdit ? 'disabled' : null}}              
                                    />
                                    <label class="text-white">Tell use longtitude coordinate</label>
                                     @error('long') <small class="text-danger">{{$message}}</small>@enderror
                                </div>                   
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">Latitude</label>
                                    <input type="text" wire:model="lat" class="form-control dark-input" 
                                        {{$isEdit ? 'disabled' : null}} 
                                    />
                                    <label class="text-white">Tell use latitude coordinate</label>
                                     @error('lat') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-white">Title</label>
                            <input type="text" wire:model="title" class="form-control dark-input" />
                            <label class="text-white">Name of location</label>
                             @error('title') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label class="text-white">plan</label>
                            <input type="text" wire:model="plan" class="form-control dark-input" />
                            <label class="text-white">Name of location</label>
                             @error('plan') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
               
                        <div class="form-group">
                            <button type="submit" class="btn active btn-{{$isEdit ? 'success text-white' : 'primary'}} btn-block">{{$isEdit ? 'Update Location' : 'Add Location'}}</button>
                            @if($isEdit)
                            <button wire:click="deleteLocationById" type="button" class="btn btn-danger active btn-block">Delete Location</button>
                            @endif
                        </div>
                    </form>
                </div>            
            </div>
        </div>  
    </div>
</div>
</div>



<div id="info" style="display:none"></div>



@push('script')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
   document.addEventListener('livewire:load',  ()  => {
      
        const defaultLocation = [106.697, -6.313];
        const coordinateInfo = document.getElementById('info');

        mapboxgl.accessToken = "pk.eyJ1Ijoic3lhdHJpYSIsImEiOiJjbDU3Y3M4czAxcmxuM2l0ZDlxejBuYTRuIn0.Sed4ONkUUIRIwzNh7KbOMA";
        let map = new mapboxgl.Map({
            container: "map",
            center: defaultLocation,
            zoom: 11.15,
            style: "mapbox://styles/mapbox/streets-v11"
        });

        map.addControl(new mapboxgl.NavigationControl());

        const loadGeoJSON = (geojson) => {

            geojson.features.forEach(function (marker) {
                const {geometry, properties} = marker
                const {iconSize, locationId, title,plan} = properties

                let el = document.createElement('div');
                el.className = 'marker' + locationId;
                el.id = locationId;
                el.style.backgroundImage = 'url({{asset("image/car2.png")}})';
                el.style.backgroundcolor = 'red';
                el.style.backgroundSize = 'cover';
                el.style.width = iconSize[0] + 'px';
                el.style.height = iconSize[1] + 'px';

                // const pictureLocation = '{{asset("/storage/images")}}' + '/' + image

                const content = `
                <div style="overflow-y: auto; max-height:400px;width:100%;">
                    <table class="table table-sm mt-2">
                         <tbody>
                            <tr>
                                <td>Title</td>
                                <td>${title}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `;
                
                let popup = new mapboxgl.Popup({ offset: 25 }).setHTML(content).setMaxWidth("400px")
;

                el.addEventListener('click', (e) => {   
                    const locationId = e.target.id;                 
                    @this.findLocationById(locationId)
                }); 
            
                

                
                if(title == '1'){
                    new mapboxgl.Marker({el,color:"orange"})
                    .setLngLat(geometry.coordinates)
                    .addTo(map)}
                
                if(title == '2'){
                     new mapboxgl.Marker({el,color:"red"})
                    .setLngLat(geometry.coordinates)
                    .addTo(map)}
                else{
                    new mapboxgl.Marker(el)
                .setLngLat(geometry.coordinates)
                .setPopup(popup)
                .addTo(map);
                }
            });
        }

        loadGeoJSON({!! $geoJson !!})

        window.addEventListener('locationAdded', (e) => {           
            swal({
                title: "Location Added!",
                text: "Your location has been save sucessfully!",
                icon: "success",
                button: "Ok",
            }).then((value) => {
                loadGeoJSON(JSON.parse(e.detail))
            });
        }) 
        
        window.addEventListener('deleteLocation', (e) => {  
            console.log(e.detail);         
            swal({
                title: "Location Delete!",
                text: "Your location deleted sucessfully!",
                icon: "success",
                button: "Ok",
            }).then((value) => {
               $('.marker' + e.detail).remove();
               $('.mapboxgl-popup').remove();
            });
        })

        window.addEventListener('updateLocation', (e) => {  
            console.log(e.detail);         
            swal({
                title: "Location Update!",
                text: "Your location updated sucessfully!",
                icon: "success",
                button: "Ok",
            }).then((value) => {
               loadGeoJSON(JSON.parse(e.detail))
               $('.mapboxgl-popup').remove();
            });
        })

        //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
        const style = "dark-v10"
        map.setStyle(`mapbox://styles/mapbox/${style}`);

        const getLongLatByMarker = () => {
            const lngLat = marker.getLngLat();           
            return 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
        }    

        map.on('click', (e) => {
            if(@this.isEdit){
                return
            }else{
                coordinateInfo.innerHTML = JSON.stringify(e.point) + '<br />' + JSON.stringify(e.lngLat.wrap());
                @this.long = e.lngLat.lng;
                @this.lat = e.lngLat.lat;
            }            
        });  
    })
</script>
@endpush
