<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CrudPost extends Component{

    use WithPagination;
    use WithFileUploads;
    public $isOpen=false;
    public $search,$file,$post=[];
    protected $listeners=['render','delete'=>'delete'];
    protected $rules=[
        'post.title'=>'required',
        'post.slug'=>'required',
        'post.body'=>'required',
        'post.status'=>'required',
    ];

    public function render(){
        $posts=Post::where('title','like','%'.$this->search.'%')->latest('id')->paginate(10);
        $categories=Category::all();
        return view('livewire.crud-post',compact('posts','categories'));
    }

    public function create(){
        $this->isOpen=true;
        $this->reset('post');
    }

    public function store(){
        $this->validate();
        $this->post['user_id']=auth()->user()->id;
        if(!isset($this->post['id'])){
            $post=Post::create($this->post);
            if ($this->file) {
                // $url=Storage::disk('public')->put('logos',$request->file('file'));
                $url=$this->file->store('posts','public');
                $post->image()->create([
                    'url'=>$url
                ]);
            }
        }else{
            $post=Post::find($this->post['id']);
            $post->update($this->post);
            if(is_object($this->file)){
                //$url=Storage::put('public/posts',$request->file('file'));
                $url=$this->file->store('posts','public');
                if($post->image){
                    Storage::delete($post->image->url);
                    $post->image()->update([
                        'url'=>$url
                    ]);
                }else{
                    $post->image()->create([
                        'url'=>$url
                    ]);
                }
            };
        }
        $this->reset(['isOpen','post']);
        $this->emitTo('Post','render');
        $this->emit('alert','Accion realizada satisfactoriamente');
    }

    public function edit($post){
        $this->resetValidation();
        $this->isOpen=true;
        $this->post=array_slice($post,0,7);
    }


    public function delete($id){
        Post::find($id)->delete();
    }

    //para generar los slug automaticamente
    public function updatedPostTitle(){
        $this->post['slug']=Str::slug($this->post['title']);
    }
}
