<?php


namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Http\Livewire\clustering;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Phpml\Clustering\KMeans;

class MapLocation extends Component
{
    public $locationId, $lat,$long,$city,$label;
    public $geoJson;
    
    public function loadLocations(){
    
        // $locations_array = Location::select('lat','long')->get();
        // $day = 3;
        // $locations_json = json_encode($locations_array);
        // $command = escapeshellcmd("clustering.py $day $locations_json");
        // $locations = json_decode(shell_exec($command));

        //---------------
        //
        $locations = Location::orderBy('created_at', 'desc')->get();
       
        //---------------------------
        //$allLabel = UserPlan:: //Ambil plan Label WHERE user id yang login ->get()
        // User Masuk ke Plan x
        // if plan x udah ada JSONnya
        //      $labels = jsondecode($AllLabel tp bagian plan x
        //-----------------
        
        $customLocations = [];
        // give foreach with array 

        
//          BUAT LABELLING        
//         function searchLabel(){
//           foreach ($labels as $label){
//             foreach ($label as $coordinate){
//                 if $coordinate[0] == $location->long && $coordinate[1] == $location->lat {
//                     return $label
//                 }
//             }
//           }
//         };
            
        
        foreach($locations as $location){
            $customLocations[] = [
                'type'=>'Feature',
                'geometry'=>[
                    'coordinates'=>[$location->long,$location->lat],
                    'type'=>'Point'],
                'properties'=>[
                    'city'=>$location->city,
                    'locationId'=>$location->id,
                    //'label'=>$searchLabel(),
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
           'user_id'=>Auth::user()->id,
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


    public function clustering(){
        $locations_asc_array = Location::select('lat','long')->get()->toArray();
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
