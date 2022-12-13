<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\User;
use App\Models\Stock;
use App\Models\Articulo;
use App\Models\detallePrestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()['role'];
        //
        if ($user == 'admin' || $user == 'secretario' || $user == 'bodega') {
            $prestamos = Prestamo::all();
        } else {
            $id = auth()->id();

            $prestamos = Prestamo::where('user_id', $id)->get();
        }



        return view('prestamo.index', compact('prestamos', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $hoy = date('Y-m-d');
        $user = auth()->user()['name'];
        $articulos = Articulo::all();


        return view('prestamo.create', compact('hoy', 'user', 'articulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $campos = [
            // 'fecha_solicitud' => 'required|date',
            // 'fecha_practica' => 'required|date',
            'nombreCompleto' => 'required|string|max:100',
            'jornada' => 'required|string|max:100',
            'carrera' => 'required|string|max:100',
            'grado' => 'required|string|max:100',
            'programa' => 'required|string|max:100',
            'seccion' => 'required|string|max:100',
            'cantidad' => 'required',
            'herramientas' => 'required'
        ];

        $mensaje = [
            'required' => 'El campo: :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        //
        $user = Auth::id();
        $datosPrestamo = $request->except('_token');
        $resta = 0;

        // $fechaPractica = date('Y-m-d');
        // $fechaSolicitud = date('Y-m-d');

        // dd($datosPrestamo);

        $cantidades = $datosPrestamo['cantidad'];
        $herramientas = $datosPrestamo['herramientas'];
        $idents = $datosPrestamo['idents'];

        $prestamo = Prestamo::create([
            'user_id' => $user,
            'fecha_solicitud' => $datosPrestamo['fecha_solicitud'],
            'fecha_practica' => $datosPrestamo['fecha_practica'],
            'nombreCompleto' => $datosPrestamo['nombreCompleto'],
            'carne' => $datosPrestamo['carne'],
            'jornada' => $datosPrestamo['jornada'],
            'carrera' => $datosPrestamo['carrera'],
            'grado' => $datosPrestamo['grado'],
            'programa' => $datosPrestamo['programa'],
            'seccion' => $datosPrestamo['seccion']
        ]);
        $prestamo->save();

        $ultimo = Prestamo::latest('id')->first()->id;


        for ($i = 0, $cuantos = count($cantidades); $i < $cuantos; $i++) {
            $detallePrestamo = detallePrestamo::create([
                'prestamo_id' => $ultimo,
                'articulo_id' => $idents[$i],
                'cantidad' => $cantidades[$i],
                'herramienta' => $herramientas[$i],
            ]);
            $detallePrestamo->save();

            $stock = Stock::find($idents[$i]);
            $resta = $stock->cantidad - $cantidades[$i];
            // dd($resta);
            Stock::where('nombreArticulo', '=', $herramientas[$i])
                ->update(['cantidad' => $resta]);
            // dd($herramientas[$i]);
            // $stock->save();
        }

        return redirect('/prestamo');
    }

    public function descargar($id)
    {
        $prestamo = Prestamo::findOrFail($id);

        $detalles = detallePrestamo::where('prestamo_id', $id)->get();

        // dd($detalles);

        return view('prestamo.descargar', compact('prestamo', 'detalles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = auth()->user()['role'];

        $prestamo = Prestamo::findOrFail($id);

        $detalles = detallePrestamo::where('prestamo_id', $id)->get();

        // dd($detalles);

        return view('prestamo.show', compact('prestamo', 'detalles', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = auth()->user()['role'];

        // $prestamo=Prestamo::findOrFail($id);


        $prestamo = Prestamo::find($id);
        if ($user == 'admin') {
            $prestamo->gerencia = 1;
            $prestamo->save();
        } else if ($user == 'bodega') {
            $prestamo->bodega = 1;
            $prestamo->save();
        }

        return redirect('/prestamo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Prestamo::destroy($id);
        return redirect('/prestamo');
    }
}
