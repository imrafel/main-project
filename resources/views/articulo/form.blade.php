

@if(count($errors)>0)
@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
            {{ $error }}
    </div>
        @endforeach
@endif

<div class="col-md-4">
    <label for="nombreArticulo" class="form-label">Nombre Articulo</label>
    <input type="text" class="form-control" name="nombreArticulo" id="nombreArticulo" placeholder="Nombre Articulo"
        value="{{ isset($articulo->nombreArticulo)?$articulo->nombreArticulo:old('nombreArticulo') }}"
    >
</div>
<div class="col-md-4">
    <label for="tipoArticulo" class="form-label">Clase articulo</label>
    <select class="form-select" aria-label="Default select example" name="claseArticulo" >
        <option selected> {{ isset($articulo->claseArticulo)?$articulo->claseArticulo:old('claseArticulo') }}</option>
        <option value="Herramienta">Herramienta</option>
        <option value="Equipo">Equipo</option>
    </select>
</div>
<div class="col-md-4">
    <label for="codigoArticulo" class="form-label">Codigo Articulo</label>
    <input type="text" class="form-control" name="codigoArticulo"  id="codigoArticulo" placeholder="Eje. 012DES"
        value="{{ isset($articulo->codigoArticulo)?$articulo->codigoArticulo:old('codigoArticulo') }}">
</div>
<div class="col-4">
    <label for="herramienta" class="form-label">Herramienta o Equipo</label>
    <input type="text" class="form-control" name="herramienta" id="herramienta" placeholder="Eje. Desarmador - Martillo - Alicate"
        value="{{ isset($articulo->herramienta)?$articulo->herramienta:old('herramienta') }}">
</div>
<div class="col-4">
    <label for="marca" class="form-label">Marca</label>
    <input type="text" class="form-control" name="marca" id="marca" placeholder="Stanley"
        value="{{ isset($articulo->marca)?$articulo->marca:old('marca') }}">
</div>
<div class="col-4">
    <label for="tipoArticulo" class="form-label">Tipo Articulo</label>
    <input type="text" class="form-control" name="tipoArticulo" id="tipoArticulo" placeholder="Eje. Plano/Cruz, Electrico/Analogico"
        value="{{ isset($articulo->tipoArticulo)?$articulo->tipoArticulo:old('tipoArticulo') }}">
</div>

<div class="col-auto">
    <label for="codigoArticulo" class="form-label">Cantidad</label>
    <input type="cantidad" class="form-control" name="cantidad"  id="cantidad" placeholder="Eje. 15"
        value="{{ isset($articulo->cantidad)?$articulo->cantidad:old('cantidad') }}">
</div>
<div class="col-4">
    <label for="imagen" class="form-label">Imagen</label>
    <input type="file" name="imagen" class="form-control" id="imagen"  >
    <br>
    @if(isset($articulo->imagen))
    <img src="{{ asset('storage') . '/' . $articulo->imagen }}" alt="imagen" width="250">
    @endif
</div>
<div class="col-12">
<button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
<a class="btn btn-danger" href="{{ url('/articulo')}}" >Cancelar</a>
</div>
