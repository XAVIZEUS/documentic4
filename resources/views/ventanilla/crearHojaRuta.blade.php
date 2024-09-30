<!DOCTYPE html>
<html lang="en">

<head>

    <x-head/>
    <title>Menu</title>

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

    <!-- jquery-ui stylos -->
    <link rel="stylesheet" href="{{ asset('/vendor/jquery-ui/jquery-ui.min.css') }}">

</head>

<body id="page-top">

    <div id="wrapper">

        <x-menu />
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
                                            <h1 class="font-weight-bold text-success h1  mb-4">HOJA DE RUTA</h1>
                                        </div>
                                        <form class="user" action="{{ route('crear.hojaRuta') }}" method="post">
                                            @csrf
                                            <i class="fas fa-fw"></i>
                                            <hr>
                                            <div class="form-group row">
                                                <input type="hidden" name="user" id="user" class="form-control rounded-pill" value="{{Auth::user()->idUsuario}}">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label class="form-label">Remitente</label>
                                                    <input type="text" class="form-control rounded-pill"
                                                        id="nombres" name="nombres" placeholder="Ej. Alan Brito Delgado" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Cargo Remitente</label>
                                                    <input type="text" class="form-control rounded-pill"
                                                        id="cargoR" name="cargoR" placeholder="Ej. Ingeniero, Gerente, Administrator, ..."
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label class="form-label">Institución Remitente</label>
                                                    <input type="text" class="form-control rounded-pill"
                                                        id="institucion" name="institucion" placeholder="Empresa, Instituto, Oficina, etc"
                                                        required>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label>Numero telefono, celular:</label>
                                                    <input type="text" class="form-control rounded-pill" id="telefono" name="telefono" required>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="col-sm-4 mb-3 pt-2">
                                                    <label>Oficina destino:</label>
                                                    <select class="form-control form-select rounded-pill" name="ofi" id="ofi">
                                                        @foreach ($oficinas as $oficina)
                                                            <option class="text-center"
                                                                value="{{ $oficina->idOficina }}">
                                                                {{ $oficina->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-8">
                                                    <label class="form-label">Referencia</label>
                                                    <textarea type="text" class="form-control rounded-pill"
                                                        id="ref" name="ref" placeholder="Descripcion del tramite" required></textarea>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-success btn-user btn-block">Crear Hoja de Ruta</button>

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

    <!-- jquery ui -->
    <script src="{{ asset('/vendor/jquery-ui/jquery-ui.min.js') }}"></script>


    <script>
        $('#nombres').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('ventanilla.clientesRemitente') }}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                        console.log(data);
                    }
                });
            },
            select: function(event, ui) {
                // Cuando se selecciona un destinatario, autocompletar el campo cargo
                $('#cargoR').val(ui.item.cargo);
                $('#institucion').val(ui.item.institucion);
                $('#telefono').val(ui.item.telefono);
            }
        });
    </script>

</body>

</html>
