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

    public function deletePlan($id){
        UserPlan::where('plan_id', $id)->delete();
        Locations::where('plan_id', $id)->delete();
        return redirect('/plan');
    }
}
