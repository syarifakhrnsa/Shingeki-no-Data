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

    public function deletePlan($plan_id){
        Locations::where('plan_id', $plan_id)->delete();
        UserPlan::where('plan_id', $plan_id)->delete();
        return redirect('/plan');
    }
}
