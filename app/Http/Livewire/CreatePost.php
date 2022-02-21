<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = false;
    public $title, $content;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    /* // se ejecuta cada vez que cambia una de las propiedades title or content
    public function updated($propertyName){
        // cada vez que se da una letra checa si cumple con las reglas de validación
        $this->validateOnly($propertyName);
    } */

    public function save(){
        
        $this->validate();

        sleep(1); // simular tiempo de carga internet
        
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        // Para que limpie variables y apague ventana modal
        $this->reset(['open','title','content']);

        // Para que emita el evento y lo escuche show-post
        $this->emitTo('show-posts','render');
        $this->emit('alerta', 'El Post se creó satisfactoriamente');
    }

    public function render(){
        return view('livewire.create-post');
    }

}
