<!DOCTYPE html>
<html lang="en">

<head>

    <x-head />
    <title>Menu</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .nav-pills .nav-link.active {
            background-color: #154733;
            /* Color verde para el botón activo */
            color: #fff;
            /* Color del texto en el botón activo */
            border-color: #154733;
            /* Opcional: color del borde del botón activo */
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <x-menu />

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!--HEADER -->
                <x-header />

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>-->

                    <!-- DataTales Example -->
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
                            <h2 class="m-0 font-weight-bold text-primary text-center">DOCUMENTOS ASIGNADOS A UNA HOJA DE RUTA</h2>
                        </div>

                        <div class="card-body">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border-0 shadow-none active" id="pills-todos-tab"
                                        data-toggle="pill" data-target="#pills-todos" type="button" role="tab"
                                        aria-controls="pills-todos" aria-selected="true">TODOS</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border-0 shadow-none" id="pills-cartas-tab"
                                        data-toggle="pill" data-target="#pills-cartas" type="button" role="tab"
                                        aria-controls="pills-cartas" aria-selected="false">CARTAS</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border-0 shadow-none" id="pills-informes-tab"
                                        data-toggle="pill" data-target="#pills-informes" type="button" role="tab"
                                        aria-controls="pills-informes" aria-selected="false">INFORMES</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border-0 shadow-none" id="pills-contact-tab"
                                        data-toggle="pill" data-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">OTROS</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                    <div class="tab-pane fade show active" id="pills-todos" role="tabpanel"
                                        aria-labelledby="pills-todos-tab">

                                        <x-mis-docs :$asignados/>

                                    </div>

                                    <div class="tab-pane fade show" id="pills-cartas" role="tabpanel"
                                        aria-labelledby="pills-cartas-tab">

                                        <x-mis-cartas :$asignados/>

                                    </div>
                                    <div class="tab-pane fade" id="pills-informes" role="tabpanel"
                                        aria-labelledby="pills-informes-tab">

                                        <x-mis-informes :$asignados/>

                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                        aria-labelledby="pills-contact-tab">

                                        <x-mis-otros :$asignados/>

                                    </div>

                            </div>



                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <x-footer />

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <x-modal-salir />

    <!-- Script para datatables -->
    <x-script-tablas />

    <script>
        $(document).ready(function() {
            $('#todo').DataTable();
        });
        $(document).ready(function() {
            $('#informe').DataTable();
        });
        $(document).ready(function() {
            $('#otros').DataTable();
        });
    </script>


</body>

</html>
