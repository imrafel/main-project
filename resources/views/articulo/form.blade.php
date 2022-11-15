

@if(count($errors)>0)
@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
            {{ $error }}
    </div>
        @endforeach
@endif

<div class="col-md-6">
    <label for="nombreArticulo" class="form-label">Nombre Articulo</label>
    <input type="text" class="form-control" name="nombreArticulo" id="nombreArticulo" placeholder="Nombre Articulo"
        value="{{ isset($articulo->nombreArticulo)?$articulo->nombreArticulo:old('nombreArticulo') }}"
    >
</div>
<div class="col-md-6">
    <label for="tipoArticulo" class="form-label">Tipo Articulo</label>
    <input type="text" class="form-control" name="tipoArticulo" id="tipoArticulo" placeholder="Tipo Articulo"
        value="{{ isset($articulo->tipoArticulo)?$articulo->tipoArticulo:old('tipoArticulo') }}">
</div>
<div class="col-6">
    <label for="codigoArticulo" class="form-label">Codigo Articulo</label>
    <input type="text" class="form-control" name="codigoArticulo"  id="tipoArticulo" placeholder="Codigo Articulo"
        value="{{ isset($articulo->codigoArticulo)?$articulo->codigoArticulo:old('codigoArticulo') }}">
</div>
<div class="col-6" > 
    <label for="codigoArticulo" class="form-label">Disponible</label>  
    <select class="form-select" aria-label="Default select example" name="disponible" >
        <option selected> {{ isset($articulo->disponible)?$articulo->disponible:old('disponible') }}</option>
        <option value="SI">Si</option>
        <option value="NO">No</option>
    </select>
</div>
<div class="col-md-4">
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
