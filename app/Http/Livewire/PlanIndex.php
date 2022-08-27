<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\UserPlan;
use App\Models\User;
use App\Models\Locations;

use Illuminate\Support\Facades\Auth;


class PlanIndex extends Component
{   
    protected $listeners = [
        'planCreated' => 'handleCreated',
    ];

    public function render()
    {
        return view('livewire.plan-index',[
            'plans' => UserPlan::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->latest()->get(),
        ]);
    }

    public function deletePlan($plan_id)
    {
        Locations::where('plan_id', $plan_id)->delete();
        UserPlan::where('plan_id', $plan_id)->delete();
        session()->flash('message', 'Plan deleted successfully!');
    }

    public function handleCreated($plan)
    {
        session()->flash('message', 'Plan "' . $plan['plan_name'] . '" created successfully!');
    }


}
