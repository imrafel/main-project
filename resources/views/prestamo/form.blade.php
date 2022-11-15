

@if(count($errors)>0)
@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
            {{ $error }}
    </div>
        @endforeach
@endif

<div class="col-6" > 
    <label for="user_id" class="form-label">Usuario</label>
    <select class="form-select" name="user_id">
        <option value="">--Select--</option>
        @foreach($users as $user)
        <option value="{{$user}}" {{ $user ? 'selected' : '' }}> {{ $user }}</option>
        @endforeach
    </select>
</div>
<div class="col-md-6">
    <label for="area" class="form-label">area</label>
    <input type="text" class="form-control" name="area" id="area" placeholder="Area"
        value="{{ isset($prestamo->area)?$prestamo->area:old('area') }}">
</div>

<div class="col-12">
<button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
<a class="btn btn-danger" href="{{ url('/prestamo')}}" >Cancelar</a>
</div>
