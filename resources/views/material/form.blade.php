@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif

{{-- <div class="row justify-content-center"> --}}
{{-- <form method="post" enctype="text/plain"> --}}

<table border="0">
    <tr height="30">
        <div class="row">
            <div class="col">
                <label for="">Nombre Completo</label>
                <input type="text" class="form-control" placeholder="First name" aria-label="First name"
                    name="nombreCompleto" value="{{ $user }}" readonly> 
            </div>
            <div class="col">
                <label for="">Fecha de solicitud</label>
                <input type="text" class="form-control" placeholder="First name" aria-label="First name"
                    name="fecha_solicitud" value="{{ $hoy }}" readonly>
            </div>
            <div class="col">
                <label for="">Fecha de practica</label>
                <input type="date" class="form-control" placeholder="Last name" aria-label="Last name"
                    name="fecha_practica">
            </div>
        </div>
    </tr>
    <tr height="50">
        <div class="row">
            <div class="col">
                <label for="">Carrera</label>
                <input type="text" class="form-control" placeholder="Last name" aria-label="Last name"
                    name="carrera">
            </div>
            <div class="col">
                <label for="">Programa</label>
                <input type="text" class="form-control" placeholder="Last name" aria-label="Last name"
                    name="programa">
            </div>
            <div class="col">
                <label for="autoSizingSelect">Grado</label>
                <select class="form-select" id="autoSizingSelect" name="grado">
                    <option selected>Escoger...</option>
                    <option value="1">Primero</option>
                    <option value="2">Segundo</option>
                    <option value="3">Tercero</option>
                    <option value="4">Cuarto</option>
                    <option value="5">Quinto</option>
                    <option value="6">Sexto</option>
                </select>
            </div>
        </div>
    </tr>
    <tr height="50">
        <div class="row">
            <div class="col">
                <label for="autoSizingSelect">Jornada</label>
                <select class="form-select" id="autoSizingSelect" name="jornada">
                    <option selected>Escoger...</option>
                    <option value="Matutina">Matutina</option>
                    <option value="Vespertina">Vespertina</option>
                    <option value="Ambas">Ambas</option>
                </select>
            </div>
            <div class="col">
                <label for="">practica o proyecto</label>
                <select class="form-select" id="autoSizingSelect" name="practica">
                    <option selected>Escoger...</option>
                    <option value="Practica">Practica</option>
                    <option value="Proyecto">Proyecto</option>
                </select>
            </div>
        </div>
    </tr>
    <tr height="50">
        <div class="row">
            <div class="col">
                <br>
                <p>MATERIAL Y EQUIPO QUE SE SOLICITA PARA LA PRÓXIMA SEMANA DE CLASE DE ACUERDO</p>
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="tipo" value="Anual"> Anual
                &nbsp;&nbsp;
                <input class="form-check-input" type="checkbox"  id="flexCheckDefault" name="tipo" value="Modulo" > Modulo
            </div>

        </div>
    </tr>
    <tr>
        <div class="col">
            <label for="">Cantidad</label>
        </div>
        <div class="col">
            <label for="">Herramienta</label>
        </div>
    </tr>
    <tr>
        <form id="detalle_prestamo_form" class="row g-3" action="{{ url('/detalle_prestamo') }}" method="POST">
            <div id="newRow">
            </div>
        </form>
    </tr>
    {{-- tabla para agregar herramientas  --}}
    <tr>
        <div class="col-auto">
            <br>
            <input type="button" class="btn btn-primary" id="addRow" value="Agregar">
        </div>
    </tr>
    <div class="col-12">
        <button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
        <a class="btn btn-danger" href="{{ url('/material') }}">Cancelar</a>
    </div>
</table>

</form>
</div>




<script type="text/javascript">
    // agregar registro
    $("#addRow").click(function() {
        var html = '';

        html += '<p>'
        html += '<div class="row g-3" id="inputFormRow">'
        html += '<div class="col-auto">'
        html +=
            '<input type="number" class="form-control" placeholder="Cantidad" aria-label="First name" name="cantidad[]" >'
        html += '</div>'
        html += '<div class="col">'
        html +=
            '<input type="text" class="form-control" placeholder="Material y equipo" aria-label="Last name" name="descripcion[]">'
        html += '</div>'
        html += '<div class="col-auto">'
        html += '<input type="button" class="btn btn-danger" id="removeRow" value="Eliminar" >'
        html += '</div>'
        html += '</div>'

        $('#newRow').append(html);
    });

    // borrar registro
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });


    function enviaDatos() {
        document.prestamo_form.submit();
        document.detalle_prestamo_form.submit();
    }
</script>
