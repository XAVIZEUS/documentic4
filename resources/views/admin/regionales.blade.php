<!DOCTYPE html>
<html lang="en">
    <head>

        <x-head/>
        <title>REGIONALES</title>
    
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

    <div id="wrapper">

        <x-menuadmin/>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

        
            <!-- Main content -->
            <div id="content">

                <!--HEADER -->
                <x-header/>

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
                                            <h1 class="font-weight-bold text-success h1  mb-4">REGIONALES</h1>
                                        </div>
                                        <div class="card-body" >
                                            <div class="text-center">
                                                
                                                <a class="btn btn-success" data-toggle="modal" data-target="#registrarRegional"
                                                    data-tit="Registrar">Crear Regional</a>
                                            </div>
                                            <div class="table-responsive mt-5">
                                                <table class="table table-sm table-bordered  table-hover text-center " id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>idRegion</th>
                                                            <th>Departamento</th>
                                                            <th>Ubicacion</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                
                                                    <tbody>
                                                        @foreach($regions as $region)
                                                        <tr>
                                                            @php
                                                                $idr=$region->idRegion; $dep=$region->departamento; $ubi=$region->ubicacion;
                                                            @endphp

                                                            <td>{{ $idr }}</td>
                                                            <td>{{ $dep }}</td>
                                                            <td>{{ $ubi }}</td>
                                                            <td>
                                                                <a class="btn btn-sm" title="Editar" data-toggle="modal" data-target="#registrarRegional"
                                                                 data-id-reg="{{$idr}}" data-dep="{{$dep}}" data-ubi="{{$ubi}}" data-tit="Modificar">
                                                                    <i class="fas fa-pen-alt"></i> </a>
                                                                <a class="btn btn-sm" title="Eliminar" data-toggle="modal" data-target="#eliminar"
                                                                data-id="{{$idr}}" data-nom="regions">
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
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                

            
            </div>
            <!-- end main content-->
            <x-footer/>
          

        </div>
        <!-- Fin Content wraper-->
    
    </div>
    <!-- final capa superior-->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    

    <!-- Logout Modal-->
    <x-modal-salir/>

    <!-- Registrar regional-->
    <div class="modal fade" id="registrarRegional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" action="{{ route('crear.regionales') }}" method="post">
                        @csrf
                        <h3 class="text-center" id="titulo"></h3>
                        <hr>
                        <div class="form-floating">
                            <div class="col-sm-12 mb-sm-0">
                                <label class="form-label" for="idRegion">ID Regional:</label>
                                <input type="text" class="form-control form-control-user" id="idRegion" name="idRegion" placeholder="Ejemplo: LPZ" required>
                            </div>
                            <div class="mt-3 col-sm-12">
                                <label class="form-label" for="departamento">Departamento:</label>
                                <input type="text" class="form-control form-control-user" id="departamento" name="departamento" placeholder="Ejemplo: La Paz" required>
                            </div>
                            <div class="mt-3 col-sm-12">
                                <label class="form-label" for="ubicacion">Ubicacion:</label>
                                <input type="text" class="form-control form-control-user" id="ubicacion" name="ubicacion" placeholder="Ejemplo Av. Camacho" required>
                            </div>
                            <div class="mt-3 col-sm-12">
                                <label class="form-label" for="Telefono">Telefono:</label>
                                <input type="text" class="form-control form-control-user" id="Telefono" name="Telefono" placeholder="Telefono">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-user btn-block mt-5">Guardar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <x-modal-eliminar/>
    <!-- Script para datatables -->
    <x-script-tablas/>

    <script>
        $('#registrarRegional').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            if(button.data('tit') == 'Modificar'){
                modal.find('.modal-body #idRegion').prop('readOnly', true);
            }else{
                modal.find('.modal-body #idRegion').prop('readOnly', false);
            }
            modal.find('.modal-body #titulo').text(button.data('tit')+' Regional');
            modal.find('.modal-body #idRegion').val(button.data('id-reg'));
            modal.find('.modal-body #departamento').val(button.data('dep'));
            modal.find('.modal-body #ubicacion').val(button.data('ubi'));
        });
    </script>
    
    <script>
        $('#eliminar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find('.modal-footer #id').val(button.data('id'));
            modal.find('.modal-footer #nombre').val(button.data('nom'));

            modal.find('.modal-body #eliminar-form').prop('readOnly', false);
        });
    </script>

</body>
</html>