<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Articulo;
use App\Models\Stock;

class Disponible extends Component
{

    public $articulos = [];
    
    public $articulo;
    public $value;
    public $cantidad;
    public $descripcion;
    public $ident;
    public $cantidadList = [];
    public $herramientas = [];
    public $cantidades = [];
    public $descripciones = [];
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
            $this->cantidad = $this->value['cantidad'];
            $this->ident = $this->value['id'];
            $this->descripcion = $this->value['descripcion'];
        } else {
            $this->value = '';
        }

        for ($i = 1; $i < $this->cantidad+1; $i++) {
            array_push($this->cantidadList, $i);    
        }

    }

    public function add()
    {
        array_push($this->herramientas, $this->value->objeto);
        array_push($this->cantidades, $this->cantidad);
        array_push($this->descripciones, $this->descripcion);
        array_push($this->idents, $this->ident);
        unset($this->cantidadList);
        $this->cantidadList = array(); 
    }


    public function eliminar($key)
    {
        unset($this->herramientas[$key], $this->cantidades[$key], $this->idents[$key], $this->descripciones[$key]);
        unset($this->cantidadList);
    }


}
