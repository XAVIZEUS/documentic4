<!DOCTYPE html>
<html lang="en">

<head>

    <x-head/>
    <title>Registro Usuario</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/virtual-select.min.css') }}">




    <style>
        .bg-custom {
            background-color: #154733;
            /* Cambia este valor al color que desees */
        }

        .bg-custom-brand {
            background-color: #FFFFFF;
            /* Cambia este valor al color que desees */
            padding: 5px;
            /* Ajusta el padding según sea necesario */
            border-radius: 0px;
            /* Para bordes redondeados, opcional */
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <x-menuadmin />
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <!-- Main content -->
            <div id="content">

                <!--HEADER -->
                <x-header />

                <!-- Contienido de pagina -->
                <div class="container">

                    <!-- Contenido del Formulario -->

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="font-weight-bold text-success mb-4">REGISTRO DE USUARIOS</h1>
                                        </div>
                                        <form class="user" action="{{ route('guardar.usuario') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <hr>
                                            <i class="fas fa-fw"></i>
                                            <h3 class="text-center">DATOS DE LA EMPRESA</h3>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="region">Seleccionar Regional</label>
                                                    <select class="form-control form-select rounded-pill" name="region"
                                                        id="region">
                                                        @foreach ($region as $regionales)
                                                            <option class="text-center"
                                                                value="{{ $regionales->idRegion }}">
                                                                {{ $regionales->departamento }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="oficina">Seleccionar Oficina</label>
                                                    <select class="form-control form-select rounded-pill" name="oficina"
                                                        id="oficina">
                                                        @foreach ($oficinas as $oficina)
                                                            <option class="text-center"
                                                                value="{{ $oficina->idOficina }}">{{ $oficina->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="cargo">Seleccionar Cargo</label>
                                                    <select class="form-control form-select rounded-pill" name="cargo"
                                                        id="cargo">
                                                        @foreach ($cargos as $cargo)
                                                            <option class="text-center" value="{{ $cargo->idCargo }}">
                                                                {{ $cargo->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label>Seleccionar Rol</label><br>

                                                    <select id="rol" multiple name="rol"
                                                        placeholder="Seleccione un rol"
                                                        data-silent-initial-value-set="false">
                                                        @foreach ($roles as $rol)
                                                            <option class="text-center" value="{{ $rol->idRol }}">
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
                                                    <input type="text" class="form-control form-control-user"
                                                        value="" id="usuario" name="usuario"
                                                        placeholder="Usuario" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user"
                                                        value="" id="mosca" name="mosca" placeholder="Mosca"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="text" class="form-control form-control-user"
                                                        id="nombres" name="nombres" placeholder="Nombres" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user"
                                                        id="apellidos" name="apellidos" placeholder="Apellidos"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="email" class="form-control form-control-user"
                                                        id="correo" name="correo"
                                                        placeholder="Correo Electronico" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user"
                                                        id="carnet" name="carnet" placeholder="Carnet Identidad"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="form-control custom-file-input form-control-user rounded-pill"
                                                            id="foto" name="foto" accept="image/*">
                                                        <label
                                                            class="form-control custom-file-label rounded-pill form-text"
                                                            for="foto" data-browse="Seleccionar">Elegir
                                                            archivo</label>
                                                        <input type="hidden" id="foto-name" name="foto_name"> <!-- Campo oculto para el nombre del archivo -->
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control rounded-pill my-1"
                                                        id="celular" name="celular" placeholder="celular" required>
                                                </div>
                                            </div>

                                            <button type="submit"
                                                class="btn btn-success btn-user btn-block">Registrar Usuario</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->



            </div>
            <!-- end main content-->
            <x-footer />


        </div>
        <!-- Fin Content wraper-->

    </div>
    <!-- final capa superior-->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Logout Modal-->
    <x-modal-salir />




    <!--SCRIPTS -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>


    <script type="text/javascript" src="{{ asset('js/virtual-select.min.js') }}"></script>
    <script>
        function hoy() {
            let today = new Date();
            let day = String(today.getDate()).padStart(2, '0');
            let month = String(today.getMonth() + 1).padStart(2, '0'); // Los meses en JavaScript son 0-11
            let year = today.getFullYear();

            return `${day}${month}${year}`;
        }
        // Seleccionar los campos de nombre y apellidos
        let nombresInput = document.getElementById('nombres');
        let apellidosInput = document.getElementById('apellidos');
        let moscaInput = document.getElementById('mosca');
        let oficinaInput = document.getElementById('oficina');
        let regionalInput = document.getElementById('region');
        let usuarioInput = document.getElementById('usuario');

        // Escuchar cambios en los campos de nombre y apellidos
        nombresInput.addEventListener('input', fillMosca);
        apellidosInput.addEventListener('input', fillMosca);

        // Función para llenar automáticamente el campo de mosca con los valores del nombre y apellidos
        function fillMosca() {
            let nombres = nombresInput.value.trim().split(' ').map(name => name[0] || '').join('');
            let apellidos = apellidosInput.value.trim().split(' ').map(name => name[0] || '').join('');

            moscaInput.value = `${nombres}${apellidos}`.trim();
        }

        nombresInput.addEventListener('input', fillUsuario);
        apellidosInput.addEventListener('input', fillUsuario);
        regionalInput.addEventListener('change', fillUsuario);
        oficinaInput.addEventListener('change', fillUsuario);

        function fillUsuario() {
            let nombresU = nombresInput.value.trim().split(' ')[0];
            let apellidosU = apellidosInput.value.trim().split(' ')[0];
            //let regionValor = regionalInput.options[regionalInput.selectedIndex].textContent.substring(0,3).trim();
            let regionValor = regionalInput.value.trim();
            //let oficinaValor = oficinaInput.options[oficinaInput.selectedIndex].text.substring(0,3);
            let oficinaValor = oficinaInput.value.trim();
            console.log(regionValor);
            usuarioInput.value = `${"UB-"}${regionValor+"-"+oficinaValor+"-"}${nombresU+"."+apellidosU}`.trim();
        }
    </script>

    <script type="text/javascript">
        VirtualSelect.init({
            ele: '#rol'
        });
    </script>

    <script>
        // Código para mostrar el nombre del archivo seleccionado
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;

            // Establece el nombre del archivo en el campo oculto
            document.getElementById('foto-name').value = fileName;
        });
    </script>

</body>

</html>
