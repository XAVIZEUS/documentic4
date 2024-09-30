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

        .card-header-third a i:hover, .card-section-third a i:hover {
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

        .titulo{
            font-size: 50px;
            font-family: 'Nunito', sans-serif;
            text-align: center;
            color: #154733;
            font-weight: 900;
        }
    </style>

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
                <!-- MODAL CAMBIAR CONTRASEÑA-->
                <x-modal-cambiarPassword />

                <!-- Contienido de pagina -->
                <div class="container-fluid">

                    <!-- Page Heading 
                    <div class="d-sm-flex text-center align-items-center justify-content-between mb-4" style="background-color: #154733;"> 
                        <h1 class="h3 mb-0 text-gray-800">BIENVENIDO</h1>
                        
                    </div>-->
                    <div class="d-flex align-items-center justify-content-center mb-4 p-5"> 
                        <h1 class="h1 mb-0 text-black titulo">¡Bienvenido {{ Auth::check() ? Auth::user()->nombres.' '.Auth::user()->apellidos : 'sin usuario' }}!</h1>
                    </div>
                    

                    <!-- Content Row -->


                    <!-- Content Column -->
                    <div class="col-lg-12 mb-3">
                        <div class="row">
                            <!-- Project Card Example -->
                            <div class="col-lg-4 col-md-12 mb-3">
                                <div class="card-section card-section-third border rounded">
                                    <div class="card-header card-header-third rounded d-flex align-items-center justify-content-center">
                                        <h2 class="card-header-title mb-3 text-white">ENTRADA</h2>
                                    </div>
                                    <div class="card-body text-center mb-2">
                                        <p class="card-text">Tienes {{$segE->count()}}  entradas</p>
                                        <hr>     
                                        <a title="visitar" href="{{route('bandeja.entrada')}}"><i class="fas fa-eye rounded-circle"></i></a>
                                        <a href="{{route('bandeja.entrada')}}" class="">Visitar</a>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-lg-4 col-md-12 mb-3">
                                <div class="card-section card-section-third border rounded">
                                    <div class="card-header card-header-third rounded d-flex align-items-center justify-content-center">
                                        <h2 class="card-header-title mb-3 text-white">PENDIENTES</h2>
                                    </div>
                                    <div class="card-body text-center mb-2">
                                        <p class="card-text">Tienes {{$segP->count()}} tareas pendientes</p>
                                        <hr>
                                        <a title="visitar" href="{{route('bandeja.pendientes')}}"><i class="fas fa-eye rounded-circle"></i></a>
                                        <a href="{{route('bandeja.pendientes')}}" class="">Visitar</a>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-lg-4 col-md-12 mb-3">
                                <div class="card-section card-section-third border rounded">
                                    <div class="card-header card-header-third rounded d-flex align-items-center justify-content-center">
                                        <h2 class="card-header-title mb-3 text-white">SALIDA</h2>
                                    </div>
                                    <div class="card-body text-center mb-2">
                                        <p class="card-text">Tienes 6 salidas</p>
                                        <hr>
                                        <span><a href="#"><i class="fab fa-bluetooth rounded-circle"
                                                    aria-hidden="true"></i></a></span>
                                        <span><a href="#"><i class="fas fa-wifi rounded-circle"
                                                    aria-hidden="true"></i></a></span>
                                        <span><a href="#"><i class="fas fa-plug rounded-circle"
                                                    aria-hidden="true"></i></a></span>
                                    </div>
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

        <!--script para que aparezca el modal de cambiar contraseña-->
        <script>
            $(document).ready(function() {
                @if (Auth::check() && Auth::user()->estado == 2)
                    var myModal = new bootstrap.Modal(document.getElementById('cambiarPassword'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    myModal.show();
                @endif


            });
        </script>


        <!-- Core plugin JavaScript-->
        <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts

    <script src="{{ asset('/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('/js/demo/chart-pie-demo.js') }}"></script>
    -->

</body>

</html>
