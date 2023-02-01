<?php

namespace App\Http\Controllers;

use App\Exports\PrestamosExport;
use App\Models\Prestamo;
use App\Models\Articulo;
use App\Models\detallePrestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


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

        if ($user == 'admin' || $user == 'secretario' || $user == 'bodega') {
            // $prestamo = request()->get('prestamo');
            // $buscarPor = request()->get('buscarPor');
            // if (!$prestamo) {
            //     $prestamos = Prestamo::where('finalizado', '=', 'abierto')->get();
            // } else {
            //     $prestamos = Prestamo::where($buscarPor, '=', $prestamo)->get();
            // }
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
            'nombreCompleto' => 'required|string|max:100',
            'jornada' => 'required|string|max:100',
            'carrera' => 'required|string|max:100',
            'grado' => 'required|string|max:100',
            'programa' => 'required|string|max:100',
            'seccion' => 'required|string|max:100',
            'cantidad' => 'required',
            'herramientas' => 'required',
            
        ];

        $mensaje = [
            'required' => 'El campo: :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        //
        $user = Auth::id();
        $datosPrestamo = $request->except('_token');
        $resta = 0;
        $estado = 'abierto';


        $idents = $datosPrestamo['idents'];
        $cantidades = $datosPrestamo['cantidad'];
        $herramientas = $datosPrestamo['herramientas'];
        $descripciones = $datosPrestamo['descripciones'];


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
            'seccion' => $datosPrestamo['seccion'],
            'finalizado' => $estado
        ]);
        $prestamo->save();

        $ultimo = Prestamo::latest('id')->first()->id;


        for ($i = 0, $cuantos = count($cantidades); $i < $cuantos; $i++) {
            $detallePrestamo = detallePrestamo::create([
                'prestamo_id' => $ultimo,
                'articulo_id' => $idents[$i],
                'cantidad' => $cantidades[$i],
                'herramienta' => $herramientas[$i],
                'descripcion' => $descripciones[$i]
            ]);
            $detallePrestamo->save();

            $stock = Articulo::find($idents[$i]);
            $resta = $stock->cantidad - $cantidades[$i];
            Articulo::where('objeto', '=', $herramientas[$i])
                ->update(['cantidad' => $resta]);
            // $stock->save();
        }

        return redirect('/prestamo');
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

    public function export($id) 
    {
        $prestamo = Prestamo::findOrFail($id);
        $detalles = detallePrestamo::where("prestamo_id", $id)->get();
        return Excel::download(new PrestamosExport($prestamo, $detalles), 'prestamo.xlsx');

    }

    public function pdf ($id){
        $prestamo = Prestamo::findOrFail($id);
        $detalles = detallePrestamo::where("prestamo_id", $id)->get();

        // return view('prestamo.pdf', compact('prestamo', 'detalles'));

        $pdf = PDF::loadView('prestamo.pdf', ['prestamo' => $prestamo, 'detalles' => $detalles]);
        return $pdf->stream();


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
    public function destroy(Request $request, $id)
    {

        $datos = $request->except('_token');

        // dd($datos);

        $idents = $datos['id'];
        $cantidades = $datos['cantidad'];
        $herramientas = $datos['herramienta'];
        $entregados = $datos['entregado'];
        $observaciones = $datos['observacion'];
        $hayNo = 0;

        $todo = [];

        foreach ($idents as $key => $dato) {
            $dato = array(
                'id' => $idents[$key],
                'cantidad' => $cantidades[$key],
                'herramienta' => $herramientas[$key],
                'entregado' => $entregados[$key],
                'observacion' => $observaciones[$key]
            );
            array_push($todo, $dato);
        }

        // dd($todo);


        $prestamo = detallePrestamo::where('prestamo_id', '=', $id)->get();
        for ($i = 0, $cuantos = count($prestamo); $i < $cuantos; $i++) {

            $stock = Articulo::find($prestamo[$i]['articulo_id']);
            $suma = $stock->cantidad + $prestamo[$i]['cantidad'];
            $articulo = Articulo::find($prestamo[$i]['articulo_id']);

            if ($todo[$i]['entregado'] == 'no') {
                detallePrestamo::where('articulo_id', $todo[$i]['id'])
                    ->where('prestamo_id', '=', $id)
                    ->update(['observacion' => $todo[$i]['observacion']]);
                detallePrestamo::where('articulo_id', $todo[$i]['id'])
                    ->update(['entregado' => $todo[$i]['entregado']]);
                $hayNo++;
            } else {
                detallePrestamo::where('articulo_id', $todo[$i]['id'])
                    ->where('prestamo_id', '=', $id)
                    ->update(['observacion' => $todo[$i]['observacion']]);
                detallePrestamo::where('articulo_id', $todo[$i]['id'])
                    ->update(['entregado' => $todo[$i]['entregado']]);
                if($articulo->cantidad < $articulo->total ){
                    $articulo->cantidad = $suma;
                    $articulo->save();
                }
            }
        }


        if ($hayNo == 0) {
            Prestamo::where('id', $id)
                ->update(['finalizado' => 'cerrado']);
            return redirect('/prestamo');
        } else {
            return redirect('/prestamo');
        }
    }
}
