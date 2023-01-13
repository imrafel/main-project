

@if(count($errors)>0)
@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
            {{ $error }}
    </div>
        @endforeach
@endif

<div class="col-md-4">
    <label for="codigo" class="form-label">Codigo</label>
    <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo"
        value="{{ isset($articulo->codigo)?$articulo->codigo:old('codigo') }}"
    >
</div>
<div class="col-md-4">
    <label for="objeto" class="form-label">Objeto</label>
    <input type="text" class="form-control" name="objeto" id="objeto" placeholder="Objeto"
        value="{{ isset($articulo->objeto)?$articulo->objeto:old('objeto') }}"
    >
</div>
<div class="col-md-4">
    <label for="descripcion" class="form-label">Descripcion</label>
    <input type="text" class="form-control" name="descripcion"  id="descripcion" placeholder="de 8'"
        value="{{ isset($articulo->descripcion)?$articulo->descripcion:old('descripcion') }}">
</div>
<div class="col-md-4">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="cantidad"
        value="{{ isset($articulo->cantidad)?$articulo->cantidad:old('cantidad') }}">
</div>
<div class="col-md-4">
    <label for="fecha" class="form-label">fecha</label>
    <input type="text" class="form-control" name="fecha"  id="fecha" placeholder="fecha"
        value="{{ isset($articulo->fecha)?$articulo->fecha:old('fecha') }}">
</div>
<div class="col-12">
<button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
<a class="btn btn-danger" href="{{ url('/articulo')}}" >Cancelar</a>
</div>
