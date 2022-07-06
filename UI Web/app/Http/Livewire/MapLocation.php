<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MapLocation extends Component
{
    public $lat, $long;
    
    public function render()
    {
        return view('livewire.map-location');
    }
}
