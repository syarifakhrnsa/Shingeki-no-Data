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

    // return function render wit $id parameter 
    public function loadMap($id)
    {
        $this->isEdit = false;
        $this->plan_id = $id;
        $plan = UserPlan::where('plan_id', $id)->first();
        
        $this->labels = $plan->labels;
        $this->locations = Locations::where('plan_id', $id)->orderBy('title', 'desc')->get();

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

    public function addLocation($id) {
        $data = request()->validate([
            'title' => 'required',
            'long' => 'required',
            'lat' => 'required',
        ]);
        $data['plan_id'] = $id;

        Locations::create($data);
        $locations = Locations::where('plan_id', $id)->orderBy('title', 'desc')->get();
        foreach($locations as $location) {
            $location->label = null;
            $location->save();
        }

        return redirect('/map/' . $id);
    }

    public function deleteLocation($locationid, $planid) {
        Locations::where('id', $locationid)->delete();

        $locations = Locations::where('plan_id', $planid)->orderBy('title', 'desc')->get();
        foreach($locations as $location) {
            $location->label = null;
            $location->save();
        }

        return redirect('/map/' . $planid);
    }

    public function kmeans($id) {
        $duration = request()->duration;
        $locationsAssoc = Locations::select('lat','long')->where('plan_id', $id)->get()->toArray();
        $locationsValue = [];
        $locations = Locations::where('plan_id', $id)->get();
        foreach($locationsAssoc as $array) {
            array_push($locationsValue, array_values($array));
        }

        $kMeans = new KMeans($duration);
        $cluster = $kMeans->cluster($locationsValue);
        $label_index = 0;
        $plan = UserPlan::where('plan_id', $id)->update(['duration' => $duration]);
        
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

        return redirect('/map/' . $id);
    }
}