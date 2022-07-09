<?php


namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Http\Livewire\clustering;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Phpml\Classification\KNearestNeighbors;


use Phpml\Classification\KMeans;

class MapLocation extends Component
{
    public $locationId, $lat, $long,$city;
    public $geoJson;
    
    public function loadLocations(){
    
        // $locations_array = Location::select('lat','long')->get();
        // $day = 3;
        // $locations_json = json_encode($locations_array);
        // $command = escapeshellcmd("clustering.py $day $locations_json");
        // $locations = json_decode(shell_exec($command));

        $locations = Location::orderBy('created_at', 'desc')->get();

        $customLocations = [];
        // give foreach with arraya 

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

        // get and convert to array type of json
        // $locations_array = Location::select('lat','long')->get();
        // $day = 3;
        // $locations_json = json_encode($locations_array);
        // $command = escapeshellcmd("clustering.py $day $locations_json");
        // $output = json_decode(shell_exec($command));



        $locations_array = Location::select(['locations.lat','locations.long'])->get()->toArray();
        $day = 3;
        // $array = array_values($locations_array);
        // $locations_json = json_encode($array);
        // $command = escapeshellcmd("App\Http\Livewire\clustering.py $day $locations_json");
                
        // $output = shell_exec($command);

        // $prosess = new Process(['python3 App\Http\Livewire\clustering.py','ls']);
        // $prosess->run();

        // if (!$prosess->isSuccessful()) {
        //     throw new ProcessFailedException($prosess);


        // }
        // $kMeans = new KMeans($day);
        // $test=$kMeans->cluster($locations_array);

        // var_dump($test);
        
        // execute clustering.py file





        

        // var_dump($output);

        // return view('home',compact('day','locations_json'));



    }
}
