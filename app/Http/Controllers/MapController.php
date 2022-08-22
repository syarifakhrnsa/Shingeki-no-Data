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
        return redirect('/map/1');
    }

    public function deleteLocation($locationid) {
        Locations::where('id', $locationid)->delete();
        loadMap($this->plan_id);
    }

    public function kmeans($id) {
        $duration = request()->duration;
        $locations_asc_array = Locations::select('lat','long')->where('plan_id', $id)->get()->toArray();
        $locations = [];
        foreach($locations_asc_array as $array) {
            array_push($locations, array_values($array));
        }

        $kMeans = new KMeans($duration);
        $cluster = $kMeans->cluster($locations);

        $plan = UserPlan::where('plan_name', 'Plan 1')->update(['label' => json_encode($cluster), 'duration' => $duration]);                         
        return redirect('/map/1');
    }


       function searchLabel(){
        $locations = $this->locations;
        $labels = $this->labels;
        // if labels is not null
        if($labels != null){
            $labelsDecoded = json_decode($labels);
            foreach($labelsDecoded as $label){
                foreach($labels as $coordinate){
                    if($coordinate[0] == $locations->long && $coordinate[1] == $locations->lat)  {
                        return $label;
                    }
                }
            }
        }
    } 
}




        // foreach($locations as $location){
        //     $customLocation[] = [
        //         'type' => 'Feature',
        //         'geometry' => [
        //             'coordinates' => [
        //                 $location->long, $location->lat
        //             ],
        //             'type' => 'Point'
        //         ],
        //         'properties' => [
        //             'iconSize' => [50,50],
        //             'locationId' => $location->id,
        //             'title' => $location->title,
        //             'label' => $this->searchLabel(),
        //         ]
        //     ];
        // };

        // $geoLocations = [
        //     'type' => 'FeatureCollection',
        //     'features' => $customLocation
        // ];  
        
        // $geoJson = collect($geoLocations)->toJson();
        // $this->geoJson = $geoJson;
    