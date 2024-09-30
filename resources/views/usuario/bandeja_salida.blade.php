<!DOCTYPE html>
<html lang="en">

<head>

    <x-head/>
    <title>Salidas</title>

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
                <!-- MODAL CAMBIAR CONTRASEÑA-->
                <x-modal-cambiarPassword />

                <!-- Contienido de pagina -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary text-center">BANDEJA DE SALIDA</h3>
                            <h5 class="m-0 text-primary text-center">---------------</h5>
                        </div>

                        <div class="card-body table-responsive">

                            <table class="col-12 justify-content-cented-flex">
                                @foreach ($seguimientos as $seg)
                                    <thead>
                                        <tr>
                                            <th colspan="8" class="text-white bg-success"> HOJA DE RUTA:
                                                {{ $seg->idHruta }} | {{$seg->idSeguimiento}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <th>DERIVADO A:</th>
                                            <td colspan="3"><mark class="py-0">{{ $seg->derivadoA ? $seg->derivadoA->usuario : 'Oficina '.$seg->observacion}}</mark></td>
                                            <th>REFERENCIA:</th>
                                            <td> <mark class="py-0">{{ $seg->roadmaps->referencia }}</mark></td>
                                            <th>OBSERVACION:</th>
                                            <td>{{ $seg->observacion }}</td>
                                        </tr>
                                        <tr>
                                            <th>FECHA:</th>
                                            <td>{{ $seg->f_derivacion }}</td>
                                            <th>FECHA RECIBIDO:</th>
                                            <td>{{ $seg->f_recepcion ? $seg->f_recepcion : 'No recibido' }}</td>
                                            <th>REMITENTE: </th>
                                            <td>{{ $seg->roadmaps->remitente." - ".$seg->roadmaps->cargo_remitente }} </td>
                                            <th>ACCION:</th>
                                            <td> {{ $seg->actions->nombre }}</td>
                                        </tr>
                                        <tr> 
                                            <td colspan="4">
                                                <div class="input-group justify-content-center">
                                                    @if ($seg->estado == 3)
                                                        <button type="button" class="btn btn-info btn-sm mx-2 my-1" 
                                                        title="Ya no se puede corregir" disabled> Corregir Derivacion</button>
                                                    @else                                                        
                                                        <button type="button" class="btn btn-info btn-sm mx-2 my-1"
                                                        data-toggle="modal" data-target="#selecofi"
                                                        data-idh-ruta="{{ $seg->idHruta }}"
                                                        data-id-seg="{{ $seg->idSeguimiento }}"
                                                        data-deriv="{{ $seg->derivadoA? $seg->derivadoA->idOficina : $seg->observacion }}">Corregir Derivacion</button>
                                                        <button type="button" class="btn btn-danger btn-sm mx-2 my-1"
                                                        data-toggle="modal" data-target="#elimSeg"
                                                        data-id-seg="{{ $seg->idSeguimiento }}">Eliminar</button>
                                                    @endif
                                                </div>
                                            </td>
                                            <th>PROVEIDO:</th>
                                            <td>{{ $seg->proveido }}</td>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#documentos{{ $seg->idSeguimiento }}">
                                                    Documentos <li class="fas fa-file">
                                                </button>
                                                <x-modal-documentos :seg="$seg" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="bg-dark"></td>
                                        </tr>
                                    </tbody>
                                @endforeach


                            </table>
                            <a href="{{ route('generar.reporte', Auth::user()->idUsuario) }}" class="btn btn-primary mt-3" target="_blank">Generar Reporte PDF</a>
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
                        <h5 class="modal-title" id="exampleModalLabel">CORREGIR DERIVACION</h5>
                    </div>
                    <div class="modal-body">Seleccione la oficina destino para derivar:
                    </div>
                    <div class="modal-footer">
                        <form id="selec-ofi-form" method="POST" action="{{ route('corregir.seguimiento') }}">
                            @csrf
                            <!-- Otros campos del formulario aquí -->
                            <div class="input-group">
                                <input type="hidden" name="idh" id="idh" />
                                <input type="hidden" name="idSeg" id="idSeg" />
                                <select class="form-control form-select rounded-pill mx-2" name="ofi" id="ofi">
                                    
                                </select>

                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </form>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar seguimiento-->
        <div class="modal fade" id="elimSeg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR SEGUIMIENTO</h5>
                    </div>
                    <div class="modal-body">¿Esta seguro que desea eliminar este seguimiento?
                    </div>
                    <div class="modal-footer">
                        <form id="elim-seg" method="POST" action="{{ route('eliminar.seguimiento') }}">
                            @csrf
                            <!-- Otros campos del formulario aquí -->
                            <div class="input-group">
                                <input type="hidden" name="idSeg1" id="idSeg1" />
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
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
                // Datos para las opciones del select
                var options = [
                    @foreach ($oficinas as $oficina)
                        { value: '{{ $oficina->idOficina }}', text: '{{ $oficina->nombre }}' },
                    @endforeach
                ];

                var button = $(event.relatedTarget); 
                var modal = $(this);
                modal.find('.modal-footer #idh').val(button.data('idh-ruta')); //obteber datos del boton, camelCase
                modal.find('.modal-footer #idSeg').val(button.data('id-seg'));

                // Valor que debe ser seleccionado por defecto
                var defaultValue = button.data('deriv');

                var $select = $('#ofi');
                $select.empty();

                // Agregar las opciones al select
                options.forEach(function(option) {
                    var $option = $('<option></option>')
                        .attr('value', option.value)
                        .text(option.text);
                    if (option.value === defaultValue) {
                        $option.attr('selected', 'selected');
                    }
                    $select.append($option);
                });
            });

            $('#elimSeg').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); 
                var modal = $(this);
                modal.find('.modal-footer #idSeg1').val(button.data('id-seg'));
            });
            
        </script>


    </div>

</body>

</html>
