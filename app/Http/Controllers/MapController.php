<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use App\Models\UserPlan;

use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;

class MapController extends Controller
{
    public $plan_id, $locations, $title, $labels;
    public $isEdit;
    public $geoJson; 

    // return function render wit $plan_id parameter 
    public function loadMap($plan_id)
    {
        $this->isEdit = false;
        $this->plan_id = $plan_id;
        $plan = UserPlan::where('plan_id', $plan_id)->first();
        
        $this->labels = $plan->labels;
        $this->locations = Locations::where('plan_id', $plan_id)->orderBy('title', 'desc')->get();

        // To pass
        $labels = $this->labels;
        $locations = $this->locations;
        $isEdit = $this->isEdit;
        $title = $plan->plan_name;
        $plan_id = $this->plan_id;
        $duration = $plan->duration;

        // Labelling
            
        return view('maps', compact('locations', 'labels', 'isEdit', 'title', 'plan_id', 'duration'));
    }

    public function addLocation($plan_id) {
        $data = request()->validate([
            'title' => 'required',
            'long' => 'required',
            'lat' => 'required',
        ]);
        $data['plan_id'] = $plan_id;

        Locations::create($data);
        $locations = Locations::where('plan_id', $plan_id)->orderBy('title', 'desc')->get();
        foreach($locations as $location) {
            $location->label = null;
            $location->save();
        }

        return redirect('/map/' . $plan_id);
    }

    public function deleteLocation($plan_id, $location_id) {
        Locations::where('id', $location_id)->delete();
        //get plan id from location id
        $locations = Locations::where('plan_id', $plan_id)->orderBy('title', 'desc')->get();

        foreach ( $locations as $location) {
            $location->label = null;
            $location->save();
        }
        return redirect('/map/' . $plan_id);
    }

    public function kmeans($plan_id) {
        $duration = request()->duration;
        $locationsAssoc = Locations::select('lat','long')->where('plan_id', $plan_id)->get()->toArray();
        $locationsValue = [];
        $locations = Locations::where('plan_id', $plan_id)->get();
        foreach($locationsAssoc as $array) {
            array_push($locationsValue, array_values($array));
        }

        $kMeans = new KMeans($duration);
        $cluster = $kMeans->cluster($locationsValue);
        $label_index = 0;
        $plan = UserPlan::where('plan_id', $plan_id)->update(['duration' => $duration]);
        
        foreach($cluster as $label){
            foreach($label as $coordinate){
                foreach($locations as $location) {
                    if($coordinate[0] == $location->lat && $coordinate[1] == $location->long)  {
                        $location->label = $label_index;
                        $location->save();
                    }
                }
            }
            $label_index++;
        }

        return redirect('/map/' . $plan_id);
    }
}