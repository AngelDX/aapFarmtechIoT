<?php

namespace App\Http\Livewire;

use App\Models\Sensor;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class CrudSensor extends Component{
    use WithPagination;
    public $isOpen=false;
    public $sensor=[];
    public $datereg,$place,$location;
    protected $listeners=['render','delete'=>'delete'];
    protected $rules=[
        'sensor.temperatura'=>'required',
        'sensor.humedad'=>'required',
        'sensor.fechatreg'=>'required',
    ];

    public function render(){

        if($this->datereg){
            //dd($this->datereg);
            $sensors=Sensor::where('fechatreg','like',$this->datereg.'%')->paginate(100);
        }elseif($this->place){
            $sensors=Sensor::where('place_id',$this->place)->paginate(100);
        }elseif($this->location){
                $sensors=Sensor::where('location_id',$this->location)->paginate(100);
        }else{
            $sensors=Sensor::paginate(100);
        }

        return view('livewire.crud-sensor',compact('sensors'));
    }

    public function create(){
        $this->isOpen=true;
        $this->reset('sensor');
    }

    public function store(){
        $this->validate();
        $this->sensor['user_id']=auth()->user()->id;
        if(!isset($this->sensor['id'])){
            $sensor=Sensor::create($this->sensor);
        }else{
            $sensor=Sensor::find($this->sensor['id']);
            $sensor->update($this->sensor);
        }
        $this->reset(['isOpen','sensor']);
        $this->emitTo('Post','render');
        $this->emit('alert','Accion realizada satisfactoriamente');
    }

    public function edit($sensor){
        $this->resetValidation();
        $this->isOpen=true;
        $this->sensor=array_slice($sensor,0,8);
    }


    public function delete($id){
        Sensor::find($id)->delete();
    }

    // Generate PDF
    public function createPDF() {
        $data = Sensor::skip(0)->take(100)->get();
        $pdf = FacadePdf::loadView('reportes/pdf_view',compact('data'));
        //return $pdf->download('pdf_file.pdf');    //desacarga automaticamente
        return $pdf->stream('reportes/pdf_view',compact('data')); //abre en una pestaña como pdf
    }

}
