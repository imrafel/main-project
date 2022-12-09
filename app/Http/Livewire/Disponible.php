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
    public $ident;

    public $cantidadList = [];
    
    public $herramientas = [];
    public $cantidades = [];
    public $descripcion = [];
    public $idents = [];

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
            // dd($this->value);
            $this->cantidad = $this->value['cantidad'];
            $this->ident = $this->value['id'];
            // $this->descripcion = $this->value['']
        } else {
            $this->value = '';
        }

        for ($i = 1; $i < $this->cantidad+1; $i++) {
            array_push($this->cantidadList, $i);    
        }

    }

    public function add()
    {
        array_push($this->herramientas, $this->value->nombreArticulo);
        // dd($this->herramientas);
        array_push($this->cantidades, $this->cantidad);
        array_push($this->idents, $this->ident);
        unset($this->cantidadList);
        $this->cantidadList = array(); 
    }


    public function eliminar($key)
    {
        unset($this->herramientas[$key], $this->cantidades[$key], $this->idents[$key]);
    }


}
