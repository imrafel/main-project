

@if(count($errors)>0)
@foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
            {{ $error }}
    </div>
        @endforeach
@endif

<div class="col-md-6">
    <label for="name" class="form-label">name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="User Name"
        value="{{ isset($user->name)?$user->name:"" }}"
    >
</div>
<div class="col-md-6">
    <label for="email" class="form-label">email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="EMail"
        value="{{ isset($user->email)?$user->email:"" }}">
</div>
<div class="col-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password"  id="password" placeholder="Password"
        value="{{ isset($user->password)?$user->password:"" }}">
</div>
<div class="col-6">
    <label for="verPassword" class="form-label">Verificar Password</label>
    <input type="password" class="form-control" name="verPassword"  id="verPassword" placeholder="Verificar Password"
        value="{{ isset($user->password)?$user->password:"" }}">
</div>
<div class="col-12">
<button type="submit" class="btn btn-primary" value="Enviar">Guardar</button>
<a class="btn btn-danger" href="{{ url('/user')}}" >Cancelar</a>
</div>
