<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Location;

class PlanController extends Controller
{
    public $count = 5; 
    public $locationId,$long,$lat,$title; 
   
    public $geoJson; 
    public $isEdit = false;



    private function getLocations($id) {

        // $plan = UserPlan::find
        $locations = Locations::where('plan_id', $id)->get();

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

    public function clearForm(){
        $this->long = '';
        $this->lat = '';
        $this->title = '';
        $this->isEdit = false;
    }

    public function allPlans()
    {
        $plans = UserPlan::where('user_id', Auth::user()->id)->orderBy('plan_id', 'asc')->get();
        $user = Auth::user();
        return view('content.plan', compact('plans'));
    }

    public function newPlan(){
        $data = request()->validate([
            'plan_name' => 'required',
            'date' => 'required',
            'duration' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id;
        UserPlan::create($data);
        return redirect('/plan');
    }

    public function toMap($id){
        
        $plan = UserPlan::find($id);
        $this->getLocations($plan->id);
        $this->isEdit = false;
        return view('livewire.my-test');
    }

    public function store($id){  

        
       $this->validate(request(), [
            'title' => 'required',
            'long' => 'required',
            'lat' => 'required',
        ]);

       $plan_id =UserPlan::where('id',$id)->first();
        Locations::create([
            'plan_id' => $plan_id->id,
            'long' => $this->long,
            'lat' => $this->lat,
            'title' => $this->title,
            'user_id' => Auth::id(),
        ]);

        session()->flash('info', 'Product Created Successfully');

        $this->clearForm();
        $this->getLocations($plan_id->id);    
        $this->dispatchBrowserEvent('locationAdded', $this->geoJson);        
    }




}
