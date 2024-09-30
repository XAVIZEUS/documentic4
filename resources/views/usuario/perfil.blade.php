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

</head>

<body id="page-top">

    <div id="wrapper">

        @if (Auth::user()->roles->first()->idRol == 1)
            <x-menuadmin />
        @else 
            <x-menu />
        @endif
        
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
                                            <h1 class="font-weight-bold text-success h1  mb-4">DATOS DEL USUARIO</h1>
                                        </div>

                                        <form class="user" action="{{ route('guardar.usuario') }}" method="post">
                                            @csrf
                                            <hr>
                                            <i class="fas fa-fw"></i>
                                            <h3 class="text-center">DATOS DE LA EMPRESA</h3>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="">Regional</label>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                        value="{{ $usuario->region->idRegion . '-' . $usuario->region->departamento }}"
                                                        id="regional" name="regional"
                                                        placeholder="{{ $usuario->region->idRegion . '-' . $usuario->region->departamento }}"
                                                        readonly>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="">Oficina</label>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                        value="{{ $usuario->office->idOficina . '-' . $usuario->office->nombre }}"
                                                        id="oficina" name="oficina"
                                                        placeholder="{{ $usuario->office->idOficina . '-' . $usuario->office->nombre }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="">Cargo</label>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                        value="{{ $usuario->work->nombre }}" id="cargo"
                                                        name="cargo" placeholder="{{ $usuario->work->nombre }}"
                                                        readonly>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="">Roles</label><br>
                                                    <select class="form-control form-select rounded-pill text-center"
                                                        placeholder="Seleccione un rol"
                                                        data-silent-initial-value-set="false">
                                                        @foreach ($usuario->roles as $rol)
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
                                                    <label for="">Usuario</label><br>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                        value="{{ $usuario->usuario }}" id="usuario" name="usuario"
                                                        placeholder="Usuario" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Mosca</label><br>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                        value="{{ $usuario->mosca }}" id="mosca" name="mosca" placeholder="Mosca"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="">Nombres</label><br>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                    value="{{ $usuario->nombres }}" id="nombres" name="nombres" placeholder="Nombres" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Apellidos</label><br>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                    value="{{ $usuario->apellidos }}" id="apellidos" name="apellidos" placeholder="Apellidos"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="">Correo</label><br>
                                                    <input type="email" class="form-control rounded-pill text-center"
                                                    value="{{ $usuario->correo }}" id="correo" name="correo"
                                                        placeholder="Correo Electronico" readonly>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="">Carnet</label><br>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                    value="{{ $usuario->ci }}" id="carnet" name="carnet" placeholder="Carnet Identidad"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-6">
                                                    <label for="">Celular</label><br>
                                                    <input type="text" class="form-control rounded-pill text-center"
                                                    value="{{ $usuario->celular }}" id="celular" name="celular" placeholder="celular" readonly>
                                                </div>
                                            </div>
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

    <x-script-tablas />

</body>

</html>
