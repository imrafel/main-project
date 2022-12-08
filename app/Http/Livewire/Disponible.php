<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Articulo;

class Disponible extends Component
{

    public $articulos = [];
    public $articulo;
    public $value;
    public $cantidad;

    public function mount(){
        $this->articulos = Articulo::all();

        if($this->articulo !=''){
            $this->value = Articulo::findOrFail($this->articulo);
        } else {
            $this->value = '';
        }
    }

    public function updatedArticulo()
    {        
        if($this->articulo !=''){
            $this->value = Articulo::findOrFail($this->articulo);
            $this->cantidad = $this->value['cantidad'];
        } else {
            $this->value = '';
        }
    }

}
