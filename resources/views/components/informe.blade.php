<div class="text-center pt-1">
    <h2 class="font-weight-bold">INFORME</h2>
</div>
<hr>
@csrf
<!-- originado por-->
<!--PARA QUE EL SELECT DE LA FIRMA SE AUTOCOMPLETE-->
<input type="hidden" id="persona" value="{{ isset($doc) ? $doc->destinatario : '' }}">
<input type="hidden" name="user" id="user" value="{{ Auth::user()->idUsuario }}">
<input type="hidden" name="idTipo" id="idTipo" value="2">
<input type="hidden" name="departamento" id="departamento" value="{{ Auth::user()->region->departamento }}">
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12">
        <label for="destinatario">Destinatario:</label>
        <input type="text" class="form-control" placeholder="" id="destinatario" name="destinatario" value="{{ isset($doc) ? $doc->destinatario : '' }}"
            required>
    </div>

    <div class="col-12 mt-3">
        <label for="cargoDestinatario">Cargo Destinatario: {{ isset($doc) ? $doc->cargoDest : '-' }}</label>
        <input type="text" class="form-control" placeholder="" id="cargoDestinatario" value="{{ isset($doc) ? $doc->cargoDest : '' }}"
            name="cargoDestinatario">
    </div>

    <div class="col-12 mt-3">
        <label for="referencia">Referencia:</label>
        <textarea class="form-control" placeholder="" id="referencia" name="referencia" required>{{ isset($doc) ? $doc->referencia : '' }}</textarea >
    </div>

    <div class="col-12 mt-4 text-center">
        <label for="contenido"><strong>CONTENIDO:</strong></label>
        <textarea class="form-control" placeholder="Escriba el contenido del documento" id="contenido" name="contenido" required> {{ isset($doc) ? $doc->contenido : '' }}</textarea>
    </div>

</div>

<div class="card my-4 p-4">
    <p class="text-center"><strong>DATOS EMPRESARIALES</strong></p>
    <div class="form-group row">

        <div class="col-6">
            <label> Seleccionar firma:</label>
            <select class="form-control" aria-label="Default select example" id="firma" name="firma"
                required>
                <option class="text-center" value="0" selected>En blanco</option>
                <option class="text-center" value="1">Mi firma</option>
                <option class="text-center" value="2">Firma empresa</option>
            </select>
        </div>

        <div class="col-6">
            <label for="mosca">Mosca:</label>
            <input type="text" class="form-control" placeholder="" id="mosca" name="mosca" value="{{Auth::user()->mosca}}"
                required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 mt-3">
            <label for="remitente" class="ml-2">Remitente:</label>
            <input type="text" class="form-control" placeholder="" id="remitente" name="remitente" value="{{ isset($doc) ? $doc->remitente : '' }}"
                required>
        </div>

        <div class="col-6 mt-3">
            <label for="cargoRemitente" class="ml-2">Cargo Remitente:</label>
            <input type="text" class="form-control" placeholder="" id="cargoRemitente"
                name="cargoRemitente" value="{{ isset($doc) ? $doc->cargo : '' }}">
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var remitenteValue = document.getElementById("remitente").value; // Obtiene el valor del input
        var selectFirma = document.getElementById("firma"); // Obtiene el select

        if (remitenteValue == "UNIVERSAL BROKERS S.A") {
            remitenteValue = "2"; // Selecciona la opción correspondiente
        }else if(remitenteValue == "ANONIMO"){
            remitenteValue = "0"; // Selecciona la opción correspondiente
        }else{
            remitenteValue = "1"; // Selecciona la opción correspondiente
        }

        Array.from(selectFirma.options).forEach(function(option) {
            if (option.value === remitenteValue) {
                selectFirma.value = option.value; // Selecciona la opción correspondiente
            }
        });

    });
</script>
