<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class ShowPosts extends Component
{
    public $search, $post, $image, $idinputimagen;
    public $sort = 'id';
    public $direction = 'desc';

    public $open_edit = false;

    public function mount(){
        $this->idinputimagen = rand();
        // esto es para que la variable $image se convierta ya en un objeto
        // el cual la estaremos usando en el modal de resources/views/livewire/show-posts.blade.php
        $this->post = new Post();
    }

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    // Cuando escuches el evento render ejecuta el método render
    // protected $listeners = ['render' => 'render'];
    // Cuando el nombre de listener es igual al del método podemos omitir uno asi:
    protected $listeners = ['render'];

    public function render()
    {
        // $posts = Post::all();
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->get();
        
        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort)
    {   
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Post $post){
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();

        //check si escogieron una imagen, eliminamos imagen almacenada
        if ($this->image) {
            // eliminamos imagen almacenada
            Storage::delete([$this->post->image]);
            // subir nueva imagen
            $this->post->image = $this->image->store('public/posts-images');
        }

        $this->post->save();
        $this->reset(['open_edit', 'image']);
        $this->idinputimagen = rand();
        $this->emit('alerta', 'El Post se actualizó satisfactoriamente');
    }
    
}
