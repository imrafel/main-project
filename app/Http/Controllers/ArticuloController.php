<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // comentado para poder trabajar sin estar conectado a la base de datos
        // $datos['articulos']=Articulo::all();
        // return view('articulo.index', $datos);

        $articulo = request()->get('articulo');

        $articulos = Articulo::where('objeto','like',"%$articulo%")->get();


        // $articulos = Articulo::paginate(9);
        return view('articulo.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('articulo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos = [
            'codigo' => 'required|string|max:100',
            'objeto' => 'required|string|max:100',
            'descripcion' => 'required|string|max:100',
            'fecha' => 'required|string|max:100',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosArticulo =  request()->except('_token');
        
        Articulo::insert($datosArticulo);
        return redirect('/articulo')->with('mensaje', 'Articulo Agregado con Exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $articulo = Articulo::findOrFail($id);
        return view('articulo.show', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $articulo = Articulo::findOrFail($id);
        return view('articulo.edit', compact('articulo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // funcion para guardar datos enviados desde form.edit
        $datosArticulo = request()->except(['_token', '_method']);

        Articulo::where('id', '=', $id)->update($datosArticulo);
        return redirect('/articulo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // elimina un registro
        Articulo::destroy($id);


        return redirect('/articulo');
    }
}
