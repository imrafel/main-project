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

        $articulos = Articulo::paginate(9);
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
            'nombreArticulo' => 'required|string|max:100',
            'tipoArticulo' => 'required|string|max:100',
            'codigoArticulo' => 'required|string|max:100',
            'cantidad' => 'required|integer|max:100',
            'imagen' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'imagen.required' => 'La imagen es requerida'
        ];

        $this->validate($request, $campos, $mensaje);

        $datosArticulo =  request()->except('_token');

        // dd($datosArticulo);
        $datosArticulo['imagen'] = $request->file('imagen')->store('uploads', 'public');
        $imagen = $request->file('imagen');

        for ($i = 1, $cuantos = $datosArticulo['cantidad']+1; $i < $cuantos; $i++) {
            $articulo = new Articulo;
            $articulo->nombreArticulo   = $datosArticulo['nombreArticulo'];
            $articulo->claseArticulo    = $datosArticulo['claseArticulo'];
            $articulo->herramienta      = $datosArticulo['herramienta'];
            $articulo->marca            = $datosArticulo['marca'];
            $articulo->tipoArticulo     = $datosArticulo['tipoArticulo'];
            $articulo->cantidad         = $datosArticulo['cantidad'];
            $articulo->codigoArticulo   = $datosArticulo['codigoArticulo'] . $i;
            $articulo->imagen   = $imagen->store('uploads', 'public');
            $articulo->save();
        }


        // Guardado a la tabla de inventario

        // return redirect('/articulo')->with('mensaje', 'Articulo agregado con exito');


        //Guardado a la tabla de stock para manipular los vales de prestamo
        Stock::insert($datosArticulo);
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

        if ($request->hasFile('imagen')) {
            $articulo = Articulo::findOrFail($id);
            Storage::delete('public/' . $articulo->imagen);
            $datosArticulo['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
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

        $articulo = Articulo::findOrFail($id);

        if (Storage::delete('public/' . $articulo->imagen)) {
            Articulo::destroy($id);
        }

        return redirect('/articulo');
    }
}
