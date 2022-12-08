<div>
    <tr>
    <h5>Buscar Disponibilidad</h5>
    </tr>
    <tr>
        <div class="row g-3" id="inputFormRow">
            <div class="col-6">
                <label class="">Herramienta:</label>
                <select name="articulo" wire:model.lazy="articulo" class="form-select">
                    <option value=''>Choose a country</option>
                    @foreach ($articulos as $articulo)
                        <option value="{{ $articulo->id }}">{{ $articulo->nombreArticulo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label class="">Cantidad:</label>
                <input type="text" class="form-control" name="cantidad" value="{{ $cantidad }}" >
            </div>
        </div>
</div>