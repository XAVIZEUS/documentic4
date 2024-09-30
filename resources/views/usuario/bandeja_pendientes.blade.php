<!DOCTYPE html>
<html lang="en">

<head>
    <x-head/>
    <title>Pendientes</title>

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


                <!-- Contienido de pagina -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary text-center">BANDEJA DE PENDIENTES</h3>
                            <h5 class="m-0 text-primary text-center">---------------</h5>
                        </div>

                        <div class="card-body table-responsive">

                            <table class="col-12 justify-content-cented-flex">
                                @foreach ($seguimientos as $seg)
                                    <thead>
                                        <tr class="bg-success text-white">
                                            <th colspan="6"> HOJA DE RUTA:
                                                {{ $seg->idHruta }}|{{ $seg->idSeguimiento}}</th>
                                            <th> {{ 'ADJUNTO' }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <th class="text-right">DERIVADO POR:</th>
                                            <td>{{ $seg->derivador->usuario }}</td>
                                            <th>FECHA:</th>
                                            <td>{{ $seg->f_derivacion }}</td>
                                            <th class="col-lg-1">PROVEIDO:</th>
                                            <td>{{ $seg->proveido }}</td>
                                            <td rowspan="3" class="text-left small pl-3 col-lg-3">
                                                @forelse ($seg->documents as $documento)
                                                        <a href="{{ route('documento.ver', $documento->idDocumento) }}" target="_blank" class="text-primary">
                                                            @php
                                                                $ext = strtolower(collect(explode('.', $documento->nombre))->last());
                                                            @endphp
                                                            @if ($ext=="pdf")
                                                                <i class="fas fa-file-pdf text-danger">
                                                            @elseif (in_array($ext, ['jpg','png'])) 
                                                                <i class="fas fa-file-image text-info">
                                                            @elseif (in_array($ext, ['docx','doc'])) 
                                                                <i class="fas fa-file-word text-primary">
                                                            @elseif (in_array($ext, ['xls','xlsx'])) 
                                                                <i class="fas fa-file-excel text-success">
                                                            @else
                                                                <i>sin extencion
                                                            @endif

                                                             </i> {{$documento->nombre }}</a><br>
                                                @empty
                                                    No se encontraron documentos.
                                                @endforelse

                                            </td>

                                        </tr>

                                        <tr>
                                            <th class="text-right">REFERENCIA:</th>
                                            <td colspan="3" class="col-lg-5"> {{ $seg->roadmaps->referencia }}</td>
                                            <th>ACCION:</th>
                                            <td> {{ $seg->actions->nombre }}</td>
                                            
                                            
                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                <div class="input-group justify-content-center">
                                                    <button type="button" class="btn btn-info btn-sm mx-2 my-1"
                                                        data-toggle="modal" data-target="#selecofi"
                                                        data-idh-ruta="{{ $seg->idHruta }}"
                                                        data-id-seg="{{$seg->idSeguimiento}}"> Derivar</button>                                                    
                                                </div>
                                                
                                            </td>
                                            <th>OBSERVACION:</th> <td>{{ $seg->observacion }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="bg-dark"></td>
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



        <!-- Modal Seleccionar oficina-->
        <div class="modal fade" id="selecofi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">DERIVAR</h5>
                    </div>
                    <div class="modal-body">Seleccione la oficina destino para derivar:
                    </div>
                    <div class="modal-footer">
                        <form id="toggle-status-form" method="POST" action="{{ route('continuar.seguimiento') }}">
                            @csrf
                            <!-- Otros campos del formulario aquí -->
                            <div class="input-group">
                                <input type="hidden" name="idh" id="idh" />
                                <input type="hidden" name="idSeg" id="idSeg" />

                                <select class="form-control form-select rounded-pill mx-2" name="ofi"
                                    id="ofi">
                                    @foreach ($oficinas as $oficina)
                                        <option class="text-center" value="{{ $oficina->idOficina }}">
                                            {{ $oficina->nombre }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </form>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

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

        <script>
            $('#selecofi').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); 
                var modal = $(this);
                modal.find('.modal-footer #idh').val(button.data('idh-ruta')); //obteber datos del boton, camelCase
                modal.find('.modal-footer #idSeg').val(button.data('id-seg'));
            });
        </script>

    </div>

</body>

</html>
