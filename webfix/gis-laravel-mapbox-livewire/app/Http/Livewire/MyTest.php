<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\Marker;
use Phpml\Clustering\KMeans;

class MyTest extends Component
{
    use WithFileUploads;
    
    public $count = 5; 
    public $locationId,$long,$lat,$title; 
   
    public $geoJson; 
    public $isEdit = false;

    private function getLocations() {
        $locations = Marker::orderBy('created_at', 'desc')->get();

        $customLocation = [];

        foreach($locations as $location){
            $customLocation[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [
                        $location->long, $location->lat
                    ],
                    'type' => 'Point'
                ],
                'properties' => [
                    'iconSize' => [50,50],
                    'locationId' => $location->id,
                    'title' => $location->title,
                ]
            ];
        };

        $geoLocations = [
            'type' => 'FeatureCollection',
            'features' => $customLocation
        ];  
        
        $geoJson = collect($geoLocations)->toJson();
        $this->geoJson = $geoJson;
    }
   
    public function render()
    {
        $this->getLocations();
        return view('livewire.my-test');
    }

    // public function previewImage(){
    //     if(!$isEdit) {
    //         $this->validate([
    //             'image' => 'image|max:2048'
    //         ]);
    //     }        
    // }

    public function store(){  
        $this->validate([
            'long' => 'required',
            'lat' => 'required',
            'title' => 'required',
           
        ]);

        // $imageName = md5($this->image.microtime()).'.'.$this->image->extension();

        // Storage::putFileAs(
        //     'public/images',
        //     $this->image,
        //     $imageName
        // );

        Marker::create([
            'long' => $this->long,
            'lat' => $this->lat,
            'title' => $this->title,
            'user_id' => Auth::id(),
        ]);

        session()->flash('info', 'Product Created Successfully');

        $this->clearForm();
        $this->getLocations();    
        $this->dispatchBrowserEvent('locationAdded', $this->geoJson);        
    }

    public function update(){  
        $this->validate([
            'long' => 'required',
            'lat' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $location = Marker::findOrFail($this->locationId);
 
            $updateData = [
                'title' => $this->title,
            ];

        $location->update($updateData);

        session()->flash('info', 'Product Updated Successfully');

        $this->clearForm();
        $this->getLocations();    
        $this->dispatchBrowserEvent('updateLocation', $this->geoJson);        
    }

    public function deleteLocationById(){
        $location = Marker::findOrFail($this->locationId);
        $location->delete();

        $this->clearForm();
        $this->dispatchBrowserEvent('deleteLocation', $location->id);           
    }

    public function clearForm(){
        $this->long = '';
        $this->lat = '';
        $this->title = '';
        $this->isEdit = false;
    }

    public function findLocationById($id){
        $location = Marker::findOrFail($id);

        $this->locationId = $id;
        $this->long = $location->long;
        $this->lat = $location->lat;
        $this->title = $location->title;
        $this->isEdit = true;
    }

    public function clustering(){
        $locations_asc_array = Marker::select('lat','long')->get()->toArray();
        $day = 3;
        $locations = [];
        // deklar buat array
        foreach($locations_asc_array as $array) {
        array_push($locations, array_values($array));
         };

        $kMeans = new KMeans($day);
        $test=$kMeans->cluster($locations);

        var_dump($test);


        


        // return view('home',compact('day','locations_json'));

        

    }

}
