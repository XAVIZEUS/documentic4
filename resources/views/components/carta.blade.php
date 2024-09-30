<div class="text-center">
    <h2 class="font-weight-bold">CARTA</h2>
</div>
<hr>
@csrf
<!-- originado por-->
<div class="text-center">
    <!--PARA QUE EL SELECT DE LA FIRMA SE AUTOCOMPLETE-->
    <input type="hidden" id="persona" value="{{ isset($doc) ? $doc->destinatario : '' }}">
    <input type="hidden" name="user" id="user" value="{{ Auth::user()->idUsuario }}">
    <input type="hidden" name="idTipo" id="idTipo" value="1">
    <input type="hidden" name="departamento" id="departamento" value="{{ Auth::user()->region->departamento }}">
</div>


<div class="form-group row">
    <div class="col-sm-3 mb-2 pt-2">
        <label for="sr">Abreviatura: </label>
        <select class="form-control form-select" name="sr" id="sr" required>
            <option class="text-center" value="Sr."> Señor </option>
            <option class="text-center" value="Sra."> Señora </option>
            <option class="text-center" value="Dr."> Doctor </option>
            <option class="text-center" value="Dra."> Doctora </option>
        </select>
    </div>

    <div class="col-sm-9">
        <label class="form-label">Destinatario: </label>
        <textarea type="text" class="form-control" id="destinatarioC" name="destinatario"> {{ isset($doc) ? $doc->destinatario : '' }}</textarea>
    </div>

</div>
<div class="form-group row">
    <div class="col-sm-12">
        <label class="form-label">Referencia: </label>
        <textarea type="text" class="form-control" id="referencia" name="referencia">{{ isset($doc) ? $doc->referencia : '' }}</textarea>
    </div>
</div>
<div class="col-sm-12 text-center">
    <label class="form-label"><strong>CONTENIDO</strong> </label>
    <textarea name="contenido" id="contenido">{{ isset($doc) ? $doc->contenido : '' }}</textarea>
</div>
<div class="card my-4 p-4">
    <p class="text-center"><strong>DATOS EMPRESARIALES</strong></p>
    <div class="form-group row">

        <div class="col-6">
            <label> Seleccionar firma:</label>
            <select class="form-control" aria-label="Default select example" id="firma" name="firma">
                <option class="text-center" value="0" selected>En blanco</option>
                <option class="text-center" value="1">Mi firma</option>
                <option class="text-center" value="2">Firma empresa</option>
            </select>
        </div>

        <div class="col-6">
            <label for="mosca">Mosca:</label>
            <input type="text" class="form-control" placeholder="" id="mosca" name="mosca"
                value="{{ Auth::user()->mosca }}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 mt-3">
            <label for="remitente" class="ml-2">Remitente:</label>
            <input type="text" class="form-control" placeholder="" id="remitente" name="remitente"
                value="{{ isset($doc) ? $doc->remitente : '' }}">
        </div>

        <div class="col-6 mt-3">
            <label for="cargoRemitente" class="ml-2">Cargo Remitente:</label>
            <input type="text" class="form-control" placeholder="" id="cargoRemitente" name="cargoRemitente"
                value="{{ isset($doc) ? $doc->cargo : '' }}">
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var personaValue = document.getElementById("persona").value; // Obtiene el valor del input
        var remitenteValue = document.getElementById("remitente").value; // Obtiene el valor del input
        var selectSr = document.getElementById("sr"); // Obtiene el select
        var selectFirma = document.getElementById("firma"); // Obtiene el select

        if (remitenteValue == "UNIVERSAL BROKERS S.A") {
            remitenteValue = "2"; // Selecciona la opción correspondiente
        }else if(remitenteValue == "ANONIMO"){
            remitenteValue = "0"; // Selecciona la opción correspondiente
        }else{
            remitenteValue = "1"; // Selecciona la opción correspondiente
        }
        // Establece el valor del select
        Array.from(selectSr.options).forEach(function(option) {
            if (option.value === personaValue) {
                selectSr.value = option.value; // Selecciona la opción correspondiente
            }
        });

        Array.from(selectFirma.options).forEach(function(option) {
            if (option.value === remitenteValue) {
                selectFirma.value = option.value; // Selecciona la opción correspondiente
            }
        });

    });
</script>
