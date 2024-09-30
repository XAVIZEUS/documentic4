<!-- Modal VER documentos -->
<div class="modal fade" id="perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fs-5 text-center" id="exampleModalLabel">Perfil
                </h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-5">
                                <div class="text-center">
                                    <h1 class="font-weight-bold text-success h1">DATOS DEL USUARIO</h1>
                                </div>
                                <hr>
                                <i class="fas fa-fw"></i>
                                <h3 class="text-center mt-n3">DATOS DE LA EMPRESA</h3>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="regionalPerfil">Regional</label>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->idRegion . ' - ' . Auth::user()->load('region')->region->departamento }}"
                                            id="regionalPerfil" name="regionalPerfil"
                                            placeholder="{{ Auth::user()->idRegion . '-' . Auth::user()->idRegion }}"
                                            readonly>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="oficinaPerfil">Oficina</label>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->idOficina . '-' . Auth::user()->load('office')->office->nombre }}"
                                            id="oficinaPerfil" name="oficinaPerfil"
                                            placeholder="{{ Auth::user()->idOficina . '-' . Auth::user()->idOficina }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="cargoPerfil">Cargo</label>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->load('work')->work->nombre }}" id="cargoPerfil"
                                            name="cargoPerfil" placeholder="{{ Auth::user()->idCargo }}" readonly>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Roles</label><br>
                                        <select class="form-control form-select rounded-pill text-center"
                                            placeholder="Seleccione un rol" data-silent-initial-value-set="false">
                                            @foreach (Auth::user()->roles as $rol)
                                                <option class="text-center">
                                                    {{ $rol->nombre }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <i class="fas fa-fw"></i>
                                <h3 class="text-center">DATOS PERSONALES</h3>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="usuarioPerfil">Usuario</label><br>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->usuario }}" id="usuarioPerfil" name="usuarioPerfil"
                                            placeholder="Usuario" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="moscaPerfil">Mosca</label><br>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->mosca }}" id="moscaPerfil" name="moscaPerfil"
                                            placeholder="Mosca" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nombresPerfil">Nombres</label><br>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->nombres }}" id="nombresPerfil" name="nombresPerfil"
                                            placeholder="Nombres" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="apellidosPerfil">Apellidos</label><br>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->apellidos }}" id="apellidosPerfil" name="apellidosPerfil"
                                            placeholder="Apellidos" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="correoPerfil">Correo</label><br>
                                        <input type="email" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->correo }}" id="correoPerfil" name="correoPerfil"
                                            placeholder="Correo Electronico" readonly>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="carnetperfil">Carnet</label><br>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->ci }}" id="carnetperfil" name="carnetperfil"
                                            placeholder="Carnet Identidad" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label for="celularPerfil">Celular</label><br>
                                        <input type="text" class="form-control rounded-pill text-center"
                                            value="{{ Auth::user()->celular }}" id="celularPerfil" name="celularPerfil"
                                            placeholder="celular" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

