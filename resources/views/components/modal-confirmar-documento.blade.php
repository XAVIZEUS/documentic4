<!-- Modal VER documentos -->
<div class="modal fade" id="ConfirmarDocumentos{{ $seg->idSeguimiento }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fs-5 text-center" id="exampleModalLabel">Confirmar Recepcion de Documentos
                </h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Confirmar Recepcion de Documentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('documento.cofirmar') }}" method="post">
                            @csrf
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="confirmar" name="confirmar">
                                        <label class="form-check-label">
                                            Esta seguro de haber recibido la documentacion en FISICO
                                        </label>
                                    </div>
                                    <input type="hidden" id="idSeguimiento" name="idSeguimiento" value="{{ $seg->idSeguimiento }}" >
                                </td>
                            </tr>

                            <tr><td><button type="submit" class="btn btn-primary">Confirmar</button></td></tr>
                        </form>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
