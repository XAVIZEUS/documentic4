
<h1>Otros</h1>
<div class="table-responsive border rounded p-3">
    <table class="table table-sm table-bordered  table-hover text-center "
        id="otros" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="col-lg-2">CREACION</th>
                <th>DESCRIPCION</th>
                <th>ACCIONES</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($asignados as $asignado)
                @if ($asignado->idTipo == 3)
                    <tr>

                        <td>{{ $asignado->created_at }}</td>
                        <td>{{ $asignado->referencia }}</td>
                        <td>{{ $asignado->idTipo }}</td>

                        <td>
                            <a class="btn btn-sm text-primary" title="Editar"
                                data-toggle="modal" data-target="#editarHR"><i
                                    class="fas fa-pen-alt"></i> </a>

                            <a href="" target="_blank"
                                class="btn btn-sm text-info" title="Descargar">
                                <i class="fa fa-download text-info"
                                    aria-hidden="true"></i> </a>
                            <a class="btn btn-sm" title="Eliminar"
                                data-toggle="modal" data-target="#eliminarHR">
                                <i class="fas fa-trash-alt text-danger"></i></a>
                            <a class="btn btn-sm disabled" title="Eliminar">
                                <i class="fas fa-trash-alt text-danger"></i></a>
                        </td>

                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
</div>
