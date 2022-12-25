<?php

namespace App\Http\Livewire;

use App\Models\Sensor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartSensor extends Component{

    public function render(){
        $data=Sensor::select(DB::raw("COUNT(*) as count"))
        ->whereYear('fechatreg', date('Y'))
        ->groupBy(DB::raw("Day(fechatreg)"))
        ->pluck('count');

        return view('livewire.chart-sensor',compact('data'));
    }
}
