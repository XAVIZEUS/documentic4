<!DOCTYPE html>
<html lang="en">

<head>
    <x-head/>
    <title>Gestion de Usuarios</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .bg-custom {
            background-color: #154733; /* Cambia este valor al color que desees */
        }

        .bg-custom-brand {
            background-color: #FFFFFF; /* Cambia este valor al color que desees */
            padding: 5px; /* Ajusta el padding según sea necesario */
            border-radius: 0px; /* Para bordes redondeados, opcional */
        }

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <x-menuadmin/>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!--HEADER -->
                <x-header/>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>-->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" >
                            <h2 class="m-0 font-weight-bold text-primary text-center">GESTION DE USUARIOS</h2>
                        </div>

                        <div class="card-body" >
                            <div class="text-center">
                                <a href="{{ route('admin.registrarUser') }}"  type="button" class="btn btn-success">Registrar usuario</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered  table-hover text-center" id="dataTable" width="100%" >
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Nombre</th>
                                            <th>CI</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Regional</th>
                                            <th>Oficina</th>
                                            <th>Cargo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody class="small">
                                        @foreach($users as $user)

                                        @for($i = 0; $i < 1; $i++)
                                        <tr>
                                            <td>{{ $user->usuario }}</td>
                                            <td>{{ $user->apellidos }} {{ $user->nombres }}</td>
                                            <td>{{ $user->ci }}</td>
                                            <td>{{ $user->correo }}</td>
                                            <td>{{ $user->celular }}</td>
                                            <td>{{ $user->region->departamento }}</td>
                                            <td>{{ $user->office->nombre }}</td>
                                            <td>{{ $user->work->nombre }}</td>

                                            @if($user->estado)
                                                <td><mark class="bg-success rounded text-white">Activo</mark></td>
                                                <td class="py-1">
                                                <a href=""  class="btn btn-danger btn-sm py-0 mx-1" data-toggle="modal" data-target="#estadoM"
                                                data-user-id="{{ $user->idUsuario }}" title="Inhabilitar"><i class="fas fa-times"></i></a>
                                            @else
                                                <td> <mark class="bg-secondary rounded text-white">Inactivo</mark></td>
                                                <td class="py-1">
                                                <a href="" class="btn btn-success btn-sm py-0 mx-1" data-toggle="modal" data-target="#estadoM"
                                                data-user-id="{{ $user->idUsuario }}" title="Habilitar"><i class="fas fa-check "></i></a>
                                            @endif

                                            <a href="{{ route('usuarios.editar', $user->idUsuario) }}" title="Editar">
                                                <i class="fas fa-pen-alt text-info mx-1"></i> </a>
                                            </td>
                                        </tr>
                                        @endfor
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

            <x-footer/>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <x-modal-salir/>

    <!-- Estado Modal-->
    <div class="modal fade" id="estadoM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Cambiar estado?</h5>
                </div>
                <div class="modal-body">Esta seguro de realizar el cambio a este usuario.
                    <span id="userId"></span></p>
                </div>


                <div class="modal-footer">

                    <form id="toggle-status-form" method="POST" action="{{ route('gestionuser.cambiarStatus') }}">
                        @csrf
                        <!-- Otros campos del formulario aquí -->

                        <input type="hidden" id = "userId" name="userId" >

                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Script para datatables -->
    <x-script-tablas/>


    <script>
        $('#estadoM').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('userId');
            //console.log("ID del usuario:", userId);
            var modal = $(this);
            modal.find('.modal-footer #userId').val(userId);
        });
    </script>


</body>

</html>
