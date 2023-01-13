<div>
    <div class="row">
        <div class="col-5">
            <select wire:model.lazy="articulo" class="form-select">
                <option value=''>Escoge una herramienta</option>
                @foreach ($articulos as $articulo)
                <option value="{{ $articulo->id }}">{{ $articulo->objeto }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-5">
            <select class="form-select" wire:model.lazy="cantidad">
                @foreach ($cantidadList as $key => $item)
                <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary" wire:click.prevent="add()">Agregar</button>
        </div>
        <br><br><br>
        <tr>
            <div class="col-auto">
                @foreach ($idents as $id)
                <input name="idents[]" type="text" class="form-control" value="{{ $id }}" readonly>
                @endforeach
            </div>
        </tr>
        <tr>
            <div class="col-2">
                @foreach ($herramientas as $herramienta)
                <input name="herramientas[]" type="text" class="form-control" value="{{ $herramienta }}" readonly>
                @endforeach
            </div>
        </tr>
        <tr>
            <div class="col-3">
                @foreach ($descripciones as $des)
                <input name="descripciones[]" type="text" class="form-control" value="{{ $des }}" readonly>
                @endforeach
            </div>
        </tr>
        <tr>
            <div class="col-3">
                @foreach ($cantidades as $cantidad)
                <input name="cantidad[]" class="form-control" type="text"  value="{{ isset($cantidad)?$cantidad:old('cantidad') }}" readonly>
                @endforeach
            </div>
            <div class="col-1" >
                @foreach ($idents as $key => $id)
                    <button type="submit" class="btn btn-danger" wire:click.prevent="eliminar({{ $key }})">Eliminar</button>
                @endforeach
            </div>
        </tr>

    </div>
</div>