<?php

namespace App\Http\Livewire;

use App\Models\Locations;
use App\Models\UserPlan;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Faker\Core\Coordinates;
use Phpml\Clustering\KMeans;

class MyTest extends Component
{
    use WithFileUploads;
    
    public $count = 5; 
    public $locationId,$long,$lat,$title; 
    public $geoJson; 
    public $plan ; 
    public $isEdit = false;




    public function getLocations() {

        // $plan = UserPlan::all();
        // $this->plan = Locations::where('plan_id', mount()->id)->get();
        // $locations = Locations::where('plan_id', $this->plan)->get();

        $locations = Locations::orderBy('id', 'desc')->get();
        // $locations = Locations::where('plan_id', 49)->get();


    //    function searchLabel(){
    //     $locations = UserPlan::orderBy('created_at', 'desc')->get();
    //     $labels =json_decode($locations->pluck('label')->toJson());
    //     foreach($labels as $label){
    //         foreach($label as $coordinate){
    //           if($coordinate[0] == $locations->long && $coordinate[1] == $locations->lat)  {
    //             return $label;
    //           }

    //         }
    //     }
    //    }



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
                    // 'label' => searchLabel(),
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
   
    // return function render wit $id parameter 
    public function render()
    {
        // $this->plan = Locations::where('plan_id', $id)->get();
        // pass $id to this function
        // $this->getLocations($id);
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

        Locations::create([
            'long' => $this->long,
            'lat' => $this->lat,
            'title' => $this->title,
            'plan_id' => $this->plan,
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
            
        ]);

        $location = Locations::findOrFail($this->locationId);
 
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
        $location = Locations::findOrFail($this->locationId);
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
        $location = Locations::findOrFail($id);

        $this->locationId = $id;
        $this->long = $location->long;
        $this->lat = $location->lat;
        $this->title = $location->title;
        $this->isEdit = true;
    }

    public function clustering(){
        $locations_asc_array = Locations::select('lat','long')->get()->toArray();
        $day = 3;
        $locations = [];
        // deklar buat array
        foreach($locations_asc_array as $array) {
        array_push($locations, array_values($array));
         };

        $kMeans = new KMeans($day);
        $test=$kMeans->cluster($locations);

        // store $test variable to label in UserPlan table
        $user_plan = UserPlan::where('user_id', Auth::id())->first();
        $user_plan->label = json_encode($test);
        $user_plan->save();

        // return redirect();
        // UserPlan::c


        


        return view('content.plan');

        

    }

}
