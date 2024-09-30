<!-- Modal VER documentos -->
<div class="modal fade" id="devolver{{$seg->idSeguimiento}}"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fs-5 text-center" id="exampleModalLabel">Devolver Seguimiento
                </h3>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('bandeja.devolver') }}">
                    @csrf
                    <div class="form-floating">
                        <div class="mt-3 col-sm-12">
                            <label class="form-label" for="motivo">Motivo para la devolucion (Proveido)</label>
                            <input type="text" class="form-control rounded-pill" id="motivo" name="motivo" placeholder="Ejemplo: No trajo los documentos" required>
                            <input type="hidden" id="idSeguimiento" name="idSeguimiento" value="{{ $seg->idSeguimiento }}" >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success rounded-pill btn-block mt-5">Devolver</button>

                </form>
            </div>
        </div>
    </div>
</div>