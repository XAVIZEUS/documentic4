<!-- Modal VER documentos -->
<div class="modal fade" id="documentos{{$seg->idSeguimiento}}"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fs-5 text-center" id="exampleModalLabel">Ver documentos
                </h3>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Documento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($seg->documents as $documento)
                            <tr>
                                <td scope="row">
                                    <a href="{{ route('documento.ver', $documento->idDocumento) }}" target="_blank" class="text-black">
                                        @php
                                            $ext = strtolower(collect(explode('.', $documento->nombre))->last());
                                        @endphp
                                        @if ($ext=="pdf")
                                            <i class="fas fa-file-pdf text-danger">
                                        @elseif (in_array($ext, ['jpg','png'])) 
                                            <i class="fas fa-file-image text-info">
                                        @elseif (in_array($ext, ['docx','doc'])) 
                                            <i class="fas fa-file-word text-primary">
                                        @elseif (in_array($ext, ['xls','xlsx'])) 
                                            <i class="fas fa-file-excel text-success">
                                        @else
                                            <i>sin extencion
                                        @endif
                                        </i> {{$documento->nombre }}</a><br>
                                </td>
                            </tr>
                        @empty
                            <td class="text-center">No se encontraron documentos.</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>