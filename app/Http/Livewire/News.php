<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class News extends Component{

    public function render(){
        $news=Post::where('status','1')->latest('id')->get();
        return view('livewire.news',compact('news'));
    }
}
