@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3>Detalle articulo</h3>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="nombreArticulo" class="form-label">Nombre Articulo</label>
                    <input type="text" class="form-control" name="nombreArticulo" id="nombreArticulo"
                        placeholder="Nombre Articulo" readonly
                        value="{{ isset($articulo->nombreArticulo) ? $articulo->nombreArticulo : old('nombreArticulo') }}">
                    <label for="tipoArticulo" class="form-label">Tipo Articulo</label>
                    <input type="text" class="form-control" name="tipoArticulo" id="tipoArticulo"
                        placeholder="Tipo Articulo" readonly
                        value="{{ isset($articulo->tipoArticulo) ? $articulo->tipoArticulo : old('tipoArticulo') }}">

                    <label for="codigoArticulo" class="form-label">Codigo Articulo</label>
                    <input type="text" class="form-control" name="codigoArticulo" id="tipoArticulo"
                        placeholder="Codigo Articulo" readonly
                        value="{{ isset($articulo->codigoArticulo) ? $articulo->codigoArticulo : old('codigoArticulo') }}">
                </div>
                <div class="col-md-6">
                    <label for="imagen" class="form-label">Imagen del articulo</label>
                    <br>
                    <img src="{{ asset('storage') . '/' . $articulo->imagen }}" alt="imagen" width="250">
                </div>
                <div class="col-6">
                    <a class="btn btn-secondary" href="{{ url('/articulo')}}" >Regresar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
