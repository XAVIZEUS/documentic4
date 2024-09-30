<!DOCTYPE html>
<html lang="en">

<head>

    <x-head/>
    <title>Entradas</title>

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

        .card-section-third span i {
            padding: 17px;
            margin: 0px 10px;
            color: #fff;
            height: 50px;
            width: 50px;
            box-shadow: 1px 6px 24px #d2d2d2;
            background: linear-gradient(-90deg, #11998e, #38ef7d);
        }

        .card-header-third span i:hover,
        .card-section-third span i:hover {
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

        table,
        th,
        td {
            text-align: center;
            border: 1px solid black;
        }

        /*Para que el texto dentro de una celda este ajustado*/
        .text-ajustado {
            white-space: nowrap;
            width: 1%;
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary text-center">BANDEJA DE ENTRADA</h3>
                            <h5 class="m-0 text-primary text-center">---------------</h5>
                        </div>

                        <div class="card-body table-responsive">

                            <table class="col-12 justify-content-cented-flex ">
                                @foreach ($seguimientos as $seg)
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-white bg-success"> HOJA DE RUTA:
                                                {{ $seg->idHruta }}|{{ $seg->idSeguimiento}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <th class="bg-dark text-white text-ajustado">DERIVADO POR:</th>
                                            <td>{{ $seg->derivador->usuario }}</td>
                                            <th class="bg-dark text-white text-ajustado">REFERENCIA:</th>
                                            <td>{{ $seg->roadmaps->referencia }}</td>
                                            <th class="bg-dark text-white text-right text-ajustado">ACCION:</th>
                                            <td>{{ $seg->actions->nombre }}</td>
                                        </tr>

                                        <tr>
                                            <th class="bg-dark text-white text-ajustado">FECHA:</th>
                                            <td>{{ $seg->f_derivacion }}</td>
                                            <th class="bg-dark text-white text-right text-ajustado">PROVEIDO:</th>
                                            <td>{{ $seg->proveido }}</td>
                                            <th class="bg-dark text-white text-ajustado">OBSERVACION:</th>
                                            <td>{{ $seg->observacion }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <div class="input-group justify-content-center">
                                                    @if($seg->estado == 1)
                                                        <form method="post" action="{{ route('bandeja.recibir') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{ $seg->idSeguimiento }}"
                                                                name="ids">
                                                            <button type="submit" class="btn btn-success btn-sm mx-2 my-1">
                                                                Recepcionar </button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="btn-sm mx-2 my-1" disabled
                                                        title="Primero confirme haber recibido los documentos en fisico."> Recepcionar</button>
                                                       
                                                        <button class="btn btn-danger btn-sm mx-2 my-1" data-toggle="modal"
                                                        data-target="#devolver{{ $seg->idSeguimiento }}">
                                                        Devolver</button>
                                                        <x-modal-devolver :seg="$seg" />
                                                    @endif

                                                </div>
                                                <div class="input-group justify-content-center">
                                                    
                                                </div>
                                            </td>
                                            <td colspan="4">
                                                Documentacion:
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#documentos{{ $seg->idSeguimiento }}">
                                                    Documentos <li class="fas fa-file-alt">
                                                </button>
                                                <x-modal-documentos :seg="$seg" />
                                                @if ($seg->estado == 1)
                                                    <button type="button" class="btn btn-primary btn-sm my-1" disabled>
                                                        FISICO RECIBIDO
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm my-1"
                                                        data-toggle="modal"
                                                        data-target="#ConfirmarDocumentos{{ $seg->idSeguimiento }} ">
                                                        Fisico
                                                    </button>
                                                    <x-modal-confirmar-documento :seg="$seg" />
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="bg-dark"></td>
                                        </tr>
                                    </tbody>
                                @endforeach


                            </table>
                        </div>
                    </div>

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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


        <!-- Core plugin JavaScript-->
        <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>

    </div>

</body>

</html>
