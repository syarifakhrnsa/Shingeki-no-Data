<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class MapLocation extends Component
{
    public $locationId, $lat, $long,$city;
    public $geoJson;
    
    public function loadLocations(){
    
        $locations = Location::orderBy('created_at', 'desc')->get();

        $customLocations = [];

        foreach($locations as $location){
            $customLocations[] = [
                'type'=>'Feature',
                'geometry'=>[
                    'coordinates'=>[$location->long,$location->lat],
                    'type'=>'Point'],
                'properties'=>[
                    'city'=>$location->city,
                    'locationId'=>$location->id,
                    'day'=>$location->id,
                    ]

            ];
        }

        $geoLocation = [
            'type'=>'FeatureCollection',
            'features'=>$customLocations
        ];

        $geoJson = collect($geoLocation)->toJson();

        $this->geoJson = $geoJson;

    }


    public function saveLocation(){
       $this->validate([
           'lat'=>'required',
           'long'=>'required',
           'city'=>'required',
       ]);

       Location::create([
           'lat'=>$this->lat,
           'long'=>$this->long,
           'city'=>$this->city,
       ]);

       $this->clearForm();
       $this->loadLocations();
       $this->dispatchBrowserEvent('locationAdded',$this->geoJson);

    }

    private function clearForm(){
        $this->lat = '';
        $this->long = '';
        $this->city = '';
    }


    public function findLocationById($id){
        $location = Location::find($id);
        $this->locationId = $id;
        $this->lat = $location->lat;
        $this->long = $location->long;
        $this->city = $location->city;
    }
    
    public function render()
    {
        $this->loadLocations();
        return view('livewire.map-location');
    }
}
