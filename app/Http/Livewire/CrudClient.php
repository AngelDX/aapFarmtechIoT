<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class CrudClient extends Component{
    use WithPagination;
    public $isOpen=false;
    public $search,$client=[];
    protected $listeners=['render','delete'=>'delete'];
    protected $rules=[
        'client.firstname'=>'required',
        'client.lastname'=>'required',
        'client.email'=>'required',
        'client.cellphone'=>'required',
        'client.document'=>'required',
        'client.address'=>'required',
        'client.privacy'=>'required',
    ];
    public function render(){
        $clients=Client::where('firstname','like','%'.$this->search.'%')->paginate(10);
        return view('livewire.crud-client',compact('clients'));
    }

    public function create(){
        $this->isOpen=true;
        $this->reset('client');
    }

    public function store(){
        $this->validate();
        $this->client['user_id']=auth()->user()->id;
        if(!isset($this->client['id'])){
            $client=Client::create($this->client);
        }else{
            $client=Client::find($this->client['id']);
            $client->update($this->client);
        }
        $this->reset(['isOpen','client']);
        $this->emitTo('Post','render');
        $this->emit('alert','Accion realizada satisfactoriamente');
    }

    public function edit($client){
        $this->resetValidation();
        $this->isOpen=true;
        $this->client=array_slice($client,0,8);
    }


    public function delete($id){
        Client::find($id)->delete();
    }

}
