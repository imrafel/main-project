<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['users']=User::all();
        return view('user.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // redirect create user view

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valida el formulario
        $campos= [
            'name'=>'required|string|max:100',
            'email'=>'required|string|max:100',
            'password'=>'required|string|max:100',
            'verPassword'=>'required|string|max:100',
        ];

        // mensaje en caso de error en el formulario

        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        // compara las dos comntrase;as, en caso de error redirige con mensaje

        if($request['password'] !== $request['verPassword'] ){
            return redirect('/user/create')->with('mensaje', 'No coinciden las contrase;as');    
        }

        // encripta la contrase;a con el Hash
        
        $request['password'] = Hash::make($request['password']);

        // valida todos los datos para enviarlos

        $this->validate($request,$campos, $mensaje);    

        // toma los datos exceptuando el tocken de seguridad y la clave repetida

        $datosUser = request()->except('_token', 'verPassword');

        //inserta los datos recibidos y redirecciona al Userhome

        User::insert($datosUser);
        return redirect('/user')->with('mensaje', 'User Creado');

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

        User::destroy($id);

        return redirect('/user');
    }
}
