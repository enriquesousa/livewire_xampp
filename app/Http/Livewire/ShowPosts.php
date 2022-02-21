<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

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
    
}
