<!DOCTYPE html>
<html lang="en">

<head>

    <x-head/>
    <title>Repositorio</title>

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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Page Heading 
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>-->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" >
                            <h2 class="m-0 font-weight-bold text-primary text-center">REPOSITORIO DE TRAMITES </h2>
                        </div>

                        
                        <div class="card-body" >
                            <!--<div class="text-center">
                                <a href="{{ route('admin.registrarUser') }}"  type="button" class="btn btn-success">Registrar usuario</a>
                            </div>-->
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered  table-hover text-center " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-2">HOJA RUTA</th>
                                            <th>REFERENCIA</th>
                                            <th>DOCUMENTO</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($roadmaps as $roadmap)
                                        <tr>
                                            <td>
                                                <a href="{{ route('usuario.hojaRuta', $roadmap->idHruta) }}"> {{ ($roadmap->tipo==1 ? '':'I').$roadmap->idHruta }} 
                                                    <i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                            <td>{{ $roadmap->referencia }}</td>
                                            <td>
                                                <a  class="btn btn-sm text-primary" title="Editar" data-toggle="modal" data-target="#editarHR"
                                                data-id-hr="{{ $roadmap->idHruta }}"
                                                data-user="{{ $roadmap->user->usuario }}"
                                                data-codigo="{{$roadmap->codigo}}"
                                                data-remit="{{$roadmap->remitente}}"
                                                data-cargo-rem="{{$roadmap->cargo_remitente}}"
                                                data-inst-rem="{{$roadmap->instituto_remitente}}"
                                                data-ref="{{$roadmap->referencia}}"><i class="fas fa-pen-alt"></i> </a> 
                                                
                                                <a href="{{ 'x'/* route('usuario.descargarHojaRuta', $roadmap->idHruta) */}}" target="_blank" class="btn btn-sm text-info" title="Descargar">
                                                    <i class="fa fa-download text-info" aria-hidden="true"></i> </a>

                                                <a class="btn btn-sm" title="Eliminar" data-toggle="modal" data-target="#eliminarHR"
                                                data-id-hr="{{$roadmap->idHruta}}"> <i class="fas fa-trash-alt text-danger"></i> </a>
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

            <x-footer/>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Corregir HOJA DE RUTA-->
    <div class="modal fade" id="editarHR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CORREGIR HOJA DE RUTA</h5>
                </div>
                <div class="modal-footer">
                    <form id="selec-ofi-form" method="POST" action="{{ route('editar.hojaRuta') }}">
                        @csrf
                        <!-- Otros campos del formulario aquí -->
                        <div class="input-group">
                            <div class="col-sm-6 my-2">
                                <label>ID HOJA DE RUTA</label><br>
                                <input type="text" class="form-control rounded-pill text-center py-0"
                                    value="" id="idhr" name="idhr" readonly>
                            </div>
                            <div class="col-sm-6 my-2">
                                <label>Codigo cite</label><br>
                                <input type="text" class="form-control rounded-pill text-center"
                                    value="" id="cod" name="cod">
                            </div>
                        </div>
                        <div class="col-sm-12 my-2">
                            <label for="nomRemit">Nombre Remitente:</label><br>
                            <input type="text" class="form-control rounded-pill"
                                value="" id="nomRemit" name="nomRemit">
                        </div>
                        <div class="col-sm-12 my-2">
                            <label>Cargo remitente:</label><br>
                            <input type="text" class="form-control rounded-pill"
                                value="" id="cargoRemit" name="cargoRemit">
                        </div>
                        <div class="col-sm-12 my-2">
                            <label>Institucion Remitente:</label><br>
                            <input type="text" class="form-control rounded-pill"
                                value="" id="instRemit" name="instRemit">
                        </div>
                        <div class="col-sm-12 my-2">
                            <label>Referencia:</label><br>
                            <textarea type="text" class="form-control rounded-pill"
                                value="" id="referencia" name="referencia"></textarea>
                        </div>
                        <br>
                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Guardar cambios</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <x-modal-HR-eliminar/>

    <x-modal-salir/>
    
    <!-- Script para datatables -->
    <x-script-tablas/>

    <script>
        $('#editarHR').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); 
            var modal = $(this);
            modal.find('.modal-footer #idhr').val(button.data('id-hr'));
            modal.find('.modal-footer #cod').val(button.data('codigo'));
            modal.find('.modal-footer #nomRemit').val(button.data('remit'));
            modal.find('.modal-footer #cargoRemit').val(button.data('cargo-rem'));
            modal.find('.modal-footer #instRemit').val(button.data('inst-rem'));
            modal.find('.modal-footer #referencia').val(button.data('ref'));

        });

        $('#eliminarHR').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); 
            var modal = $(this);
            modal.find('.modal-footer #idhr').val(button.data('id-hr'));
        });
    </script>

    


</body>

</html>