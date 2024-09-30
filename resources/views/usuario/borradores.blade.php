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
                            <h2 class="m-0 font-weight-bold text-primary text-center">DOCUMENTOS PENDIENTES</h2>
                        </div>

                        <div class="card-body">
                            <!--<div class="text-center">
                                <a href="{{ route('admin.registrarUser') }}"  type="button" class="btn btn-success">Registrar usuario</a>
                            </div>-->
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered  table-hover text-center " id="dataTable"
                                    width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-2">CREACION</th>
                                            <th>NOMBRE</th>
                                            <th>TIPO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($borradores as $borrador)
                                            <tr>
                                                <td>{{ $borrador->created_at }}</td>
                                                <td>{{ $borrador->nombre }}</td>
                                                <td>{{ $borrador->idTipo }}</td>

                                                <td>
                                                    <form method="post" action="{{ route('documento.editar') }}" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="idDoc" value="{{ $borrador->cite }}">  
                                                        <button type="submit" class="btn btn-sm text-primary"><i class="fas fa-pen-alt"></i></button>
                                                    </form>
                                                    
                                                    <a href=""
                                                        target="_blank" class="btn btn-sm text-info" title="Descargar">
                                                        <i class="fa fa-download text-info" aria-hidden="true"></i> </a>
                                                    <a class="btn btn-sm" title="Eliminar" data-toggle="modal"
                                                        data-target="#eliminarHR">
                                                        <i class="fas fa-trash-alt text-danger"></i></a>
                                                    <a class="btn btn-sm disabled" title="Eliminar">
                                                        <i class="fas fa-trash-alt text-danger"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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


</body>

</html>
