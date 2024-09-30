<!DOCTYPE html>
<html lang="en">

<head>

    <x-head />
    <title>Menu</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">




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

        body {
            background: #f8f9fa;
        }

        .principal {
            margin-top: 50px;
            font-family: 'Roboto';
        }

        /*tarjeta 3*/
        .card-header-third {
            margin-top: -25px;
            height: 120px;
            box-shadow: 1px 5px 15px #a2a2a2;
            background: linear-gradient(-90deg, #11998e, #38ef7d);
        }

        .card-section-third a i {
            padding: 17px;
            margin: 0px 10px;
            color: #fff;
            height: 50px;
            width: 50px;
            box-shadow: 1px 6px 24px #d2d2d2;
            background: linear-gradient(-90deg, #11998e, #38ef7d);
        }

        .card-header-third a i:hover,
        .card-section-third a i:hover {
            box-shadow: 1px 1px 15px #000;
        }

        /*efecto shadows para todas las tarjetas*/
        .card-section {
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
        }

        /*Para el efecto sombra al pasar por encima el mouse*/
        .card-section:hover {
            box-shadow: 1px 1px 20px #d2d2d2;
        }

        .titulo {
            font-size: 50px;
            font-family: 'Nunito', sans-serif;
            text-align: center;
            color: #154733;
            font-weight: 900;
        }
    </style>

    <!-- jquery-ui stylos -->
    <link rel="stylesheet" href="{{ asset('/vendor/jquery-ui/jquery-ui.min.css') }}">

    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

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
                    <div class="card shadow mb-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary text-center">ELABORAR DOCUMENTOS</h2>
                        </div>
                    </div>
                    <div class="card shadow mb-4 ">
                        <div class="card small bg-light">
                            <div class="container ">
                                <div class="card-body">
                                    <form class="user" method="post" enctype="multipart/form-data">

                                        @if (base64_decode($idTipo) == 1)
                                            <x-carta :doc="$doc ?? null" />
                                        @elseif(base64_decode($idTipo) == 2)
                                            <x-informe :doc="$doc ?? null" />
                                        @else
                                            <p>404 NOT FOUND</p>
                                        @endif

                                        <hr>
                                        <div class="d-flex justify-content-center align-items-center mt-4">
                                            <button type="submit" formaction="{{ route('usuario.crearDocumento') }}"
                                                class="btn btn-success mx-3 text-center rounded-pill">Ver
                                                Documento</button>
                                            <button type="submit" formaction="{{ route('documento.guardar') }}"
                                                class="btn btn-primary rounded-pill" id="guardarBorrador">Guardar
                                                Borrador</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- /.container-fluid -->



                </div>
                <!-- end main content-->



            </div>
            <!-- Fin Content wraper-->
            <x-footer />

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

        <!-- jquery ui -->
        <script src="{{ asset('/vendor/jquery-ui/jquery-ui.min.js') }}"></script>

        <script>
            CKEDITOR.replace('contenido');
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener los botones y el input
                var guardarBorradorBtn = document.getElementById('guardarBorrador');
                var borradorInput = document.getElementById('borrador');
                var destinatarioInput = document.getElementById('destinatario');
                var referenciaInput = document.getElementById('referencia');
                var contenidoInput = document.getElementById('contenido');
                var firmaInput = document.getElementById('firma');
                var moscaInput = document.getElementById('mosca');
                var remitenteInput = document.getElementById('remitente');


                // Evento click para el botón "Guardar Borrador"
                guardarBorradorBtn.addEventListener('click', function(event) {
                    // Eliminar la propiedad disabled del input
                    borradorInput.removeAttribute('disabled');
                    destinatarioInput.removeAttribute('required');
                    referenciaInput.removeAttribute('required');
                    contenidoInput.removeAttribute('required');
                    firmaInput.removeAttribute('required');
                    moscaInput.removeAttribute('required');
                    remitenteInput.removeAttribute('required');
                });
            });
        </script>

        <!-- FIRMA -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const firmaSelect = document.getElementById('firma');
                const remitenteInput = document.getElementById('remitente');
                const cargoRemitenteInput = document.getElementById('cargoRemitente');

                // Pasamos el nombre del usuario desde Laravel a JavaScript
                const nombre = "{{ Auth::user()->nombres }}"; // Nombre del usuario autenticado desde Laravel
                const apellidos = "{{ Auth::user()->apellidos }}";

                const cargo = "{{ Auth::user()->work->nombre }}";

                firmaSelect.addEventListener('change', function() {
                    // Obtener el valor seleccionado
                    const seleccion = firmaSelect.value;

                    // Establecer los valores según la opción seleccionada
                    if (seleccion == '2') {
                        remitenteInput.value = 'UNIVERSAL BROKERS S.A.';
                        cargoRemitenteInput.value = ''; // Dejar vacío el campo de cargo
                    } else if (seleccion == '1') {
                        remitenteInput.value = apellidos + " " +
                            nombre; // Usar el nombre del usuario autenticado
                        cargoRemitenteInput.value = cargo;
                    } else {
                        remitenteInput.value = 'ANONIMO'; // Opción por defecto
                        cargoRemitenteInput.value = '';
                    }
                });
            });
        </script>


        <script>
            //autocompletar jquery iu, INFORME
            $('#destinatario').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('usuario.destinatarios') }}",
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
                    $('#cargoDestinatario').val(ui.item.cargo);
                }
            });

            //autocompletar jquery iu, CARTA
            $('#destinatarioC').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('usuario.destinatariosC') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);
                            console.log(data);
                        }
                    });
                }
            });

            document.getElementById('destinatarioC').addEventListener('change', function(event) {
                // reemplazar los caracteres de la etiqueta con id "destinatarioC" que sean "||" por barra baja
                var value = event.target.value.replace(/ \|\| /g, '\n');
                document.getElementById('destinatarioC').value = value;
            });
        </script>
</body>

</html>
