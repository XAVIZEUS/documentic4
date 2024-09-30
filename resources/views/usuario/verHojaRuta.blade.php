<!DOCTYPE html>
<html lang="en">

<head>

    <x-head/>
    <title>Seguimientos</title>
    
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

        .no-border-bottom {
            border-bottom: none;
        }

        .no-border-top {
            border-top: none;
        }

    </style>

</head>

<body id="page-top">

    <div id="wrapper">
        @if(Auth::check() && (Auth::user()->roles->first()->idRol)==1)
            <x-menuadmin />
        @else
            <x-menu/>
        @endif
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

                        <div class="card-body table-responsive">
                            <h3 class="m-0 font-weight-bold text-primary text-center">HOJA DE RUTA: {{ $hr->idHruta}}</h3>
                            <h5 class="m-0 text-primary text-center">--------------------------</h5>
                            
                            <table class="col-12 justify-content-cented-flex">
                                <tbody>
                                    <tr> <th class="bg-secondary text-white py-0" colspan="6">DATOS DE LA HOJA DE RUTA</th></tr>
                                    <tr>
                                        <th>REFERENCIA:</th> <td colspan="5"><mark class="py-0">{{$hr->referencia}}</mark></td>
                                    </tr>
                                    <tr>
                                        <th>Codigo:</th> <td>{{$hr->codigo}}</td>
                                        <th>Originado por: </td> <td>{{$hr->user->usuario}}</td>
                                        <th>Fecha de Creacion:</th> <td>{{$hr->f_creacion}}</td>
                                    </tr>
                                    <tr> <th  class="bg-secondary text-white py-0" colspan="6">DATOS DEL REMITENTE</th></tr>
                                    <tr>
                                        <th>Nombre remitente: </td> <td>{{$hr->remitente}}</td>
                                        <th>Cargo:</th> <td>{{$hr->cargo_remitente}}</td>
                                        <th>Institucion:</th> <td>{{$hr->instituto_remitente}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-header"><h4 class="mb-n2 mt-4 text-success text-center"><strong>SEGUIMIENTOS</strong></h4></div>

                        <div class="card-body table-responsive">
                            

                            <table class="col-12 justify-content-cented-flex small">
                                <thead>
                                    <tr class="bg-success text-white">
                                        <th class="col-auto" colspan="3">DERIVADO</th>
                                        <th class="col-auto">PROVEIDO</th>
                                        <th>OBSERVACION</th>
                                        <th>ACCION</th>
                                        <th>DOCUMENTOS</th>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="my-0 px-0 bg-success"></td>
                                    </tr>
                                </thead>
                                @foreach ($seguimientos as $seg)
                                    <tbody>
                                        <tr>
                                            <tr>
                                                <th class="pt-2 pb-0 no-border-bottom text-right text-dark">De: <mark>{{$seg->derivador->usuario}}</mark></th>
                                                <td rowspan="2"><li class="fas fa-arrow-circle-right text-success"></li></td>
                                                <th class="pt-2 pb-0 no-border-bottom text-left text-dark" ><mark> {{$seg->derivadoA? $seg->derivadoA->usuario : 'Oficina: '.$seg->observacion}}</mark></th>
                                                <td rowspan="2"> {{$seg->proveido}}</td>
                                                <td rowspan="2" class="col-auto"> {{$seg->observacion}}</td>
                                                <td rowspan="2" class="py-1"> {{$seg->actions->nombre}}</td>
                                                <td rowspan="2" class="text-left pl-3">
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
                                                        No hay documentos adjuntos.
                                                    @endforelse
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pb-2 pt-0 no-border-top text-right">{{$seg->f_derivacion}}</td>
                                                <td class="pb-2 pt-0 no-border-top text-left"> {{$seg->f_recepcion ? $seg->f_recepcion : 'No recibido'}}</td>
                                                
                                            </tr>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="my-0 px-0 bg-success"></td>
                                        </tr>
                                    </tbody>
                                    
                                @endforeach


                            </table>
                            <a href="{{ route('reporte.hruta', $hr->idHruta) }}" class="btn btn-primary my-3" target="_blank">
                                Generar Reporte <li class="fas fa-file-pdf"></li></a>
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
        <x-script-tablas/>


    </div>

</body>

</html>
