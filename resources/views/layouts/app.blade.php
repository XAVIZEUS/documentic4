<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>Menu</title>
    
        <!-- Custom fonts for this template-->
        <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
        <!-- Custom styles for this template-->
        <link href="{{ asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
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

    <div id="wrapper">
        <!-- Header -->
        @if (1 == 1)
            @include('partials.menu')
        @else
            @include('partials.menuAdmin')
        @endif

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!--HEADER-->
            @include('partials.header')

            <!-- Main Content -->
            <!-- Aqui va el contenido propio de cada pagina-->
            @yield('content')

            <!-- footer-->
            @include('partials.footer')
        </div>
        <!-- Fin Content wraper-->

    
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Salir" si desea cerrar su sesion.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ route('salir')}}">Salir</a>
                </div>
            </div>
        </div>
    </div>


    <!--SCRIPTS -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    {{/*
    <script src="{{asset('/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('/js/demo/chart-pie-demo.js')}}"></script>
    */}}
    

</body>
</html>