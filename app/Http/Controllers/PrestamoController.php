<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\User;
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
        if ($user == 'admin' || $user == 'secretario' ) {
            $prestamos = Prestamo::paginate(8);
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
        $hoy = date("m-d-y");
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
        //
        $user = Auth::id();
        $datosPrestamo = $request->except('_token');

        $fecha = $datosPrestamo['fecha_practica'];

        $fecha = date("Y-m-d");

        // dd($fecha);

        $cantidades = $datosPrestamo['cantidad'];
        $herramientas = $datosPrestamo['herramientas'];
        $descripciones = $datosPrestamo['descripcion'];

        $prestamo = Prestamo::create([
            'user_id' => $user,
            'fecha_solicitud' => $datosPrestamo['fecha_solicitud'],
            'fecha_practica' => $fecha,
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
                'cantidad' => $cantidades[$i],
                'herramienta' => $herramientas[$i],
                'descripcion' => $descripciones[$i]
            ]);
            $detallePrestamo->save();
        }




        // return response()->json($datosPrestamo);
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
        } else if ($user == 'secretario') {
            $prestamo->compra = 1;
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
