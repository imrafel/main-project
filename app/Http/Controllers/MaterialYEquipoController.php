<?php

namespace App\Http\Controllers;

use App\Models\detalle_materialYEquipo;
use App\Models\detallePrestamo;
use App\Models\materialYEquipo;
use Illuminate\Http\Request;

class MaterialYEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user()['role'];

        if ($user == 'secretario' || 'admin') {
        $solicitudes = materialYEquipo::paginate(8);
        } else {
            $id = auth()->id();
            $solicitudes = materialYEquipo::where('user_id', $id)->get();
        }
        

        return view('material.index', compact('solicitudes', 'user'));
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
        return view('material.create', compact('hoy', 'user'));
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
        $user = auth()->id();
        $datos_solicitud = request()->except('_token');

        $fecha = $datos_solicitud['fecha_practica'];

        $fecha = date('Y-m-d');

        $cantidades = $datos_solicitud['cantidad'];
        $descripciones = $datos_solicitud['descripcion'];

        $solicitud = materialYEquipo::create([
            'user_id' => $user,
            'nombreCompleto' => $datos_solicitud['nombreCompleto'],
            'fecha_solicitud' => $datos_solicitud['fecha_solicitud'],
            'fecha_practica' => $fecha,
            'carrera' => $datos_solicitud['carrera'],
            'programa' => $datos_solicitud['programa'],
            'grado' => $datos_solicitud['grado'],
            'jornada' => $datos_solicitud['jornada'],
            'practica' => $datos_solicitud['practica'],
            'tipo' => $datos_solicitud['tipo']
        ]);

        $solicitud->save();

        $ultimo = materialYEquipo::latest('id')->first()->id;


        for ($i = 0, $cuantos = count($cantidades); $i < $cuantos; $i++) {
            $detalleMaterial = detalle_materialYEquipo::create([
                'material_id' => $ultimo,
                'cantidad' => $cantidades[$i],
                'descripcion' => $descripciones[$i]
            ]);
            $detalleMaterial->save();
        }

        // return response()->json($solicitud);
        return redirect('/material');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materialYEquipo  $materialYEquipo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = auth()->user()['role'];

        $solicitud = materialYEquipo::findOrFail($id);

        $detalles = detalle_materialYEquipo::where('material_id', $id)->get();

        // dd($detalles);

        return view('material.show', compact('solicitud', 'detalles', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materialYEquipo  $materialYEquipo
     * @return \Illuminate\Http\Response
     */
    public function edit(materialYEquipo $materialYEquipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materialYEquipo  $materialYEquipo
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $user = auth()->user()['role'];

        $solicitud = materialYEquipo::find($id);
        if ($user == 'admin') {
            $solicitud->gerencia = 1;
            $solicitud->save();
        } else if ($user == 'bodega') {
            $solicitud->bodega = 1;
            $solicitud->save();
        } else if ($user == 'secretario') {
            $solicitud->compra = 1;
            $solicitud->save();
        }

        return redirect('/material');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materialYEquipo  $materialYEquipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        materialYEquipo::destroy($id);
        return redirect('/material');
    }
}
