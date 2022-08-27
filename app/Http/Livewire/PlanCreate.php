<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\UserPlan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PlanCreate extends Component
{
    public $plan_name;
    public $date;
    public $duration;

    public function render()
    {
        return view('livewire.plan-create');
    }
    

    public function createPlan()
    {
        $this->validate([
            'plan_name' => 'required',
            'date' => 'required',
            'duration' => 'required',
        ]);
        $data = [
            'plan_name' => $this->plan_name,
            'date' => $this->date,
            'duration' => $this->duration,
            'user_id' => Auth::user()->id,
        ];
        $plan = UserPlan::create($data);

        $this->resetInput();
        
        $this->emit('planCreated', $plan);
    }

    public function resetInput()
    {
        $this->plan_name = null;
        $this->date = null;
        $this->duration = null;
    }
    
}
