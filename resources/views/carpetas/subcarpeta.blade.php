<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
    <title>Mi UNIDAD</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">



    <x-estilos-files />
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

        .folder-card {
            cursor: pointer;
        }

        .folder-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .folder-card i {
            font-size: 24px;
            margin-right: 10px;
        }


        /* Estilos de los embeds Para que tengan proporción 16:9 al ver los PDF */
        /* Definir una proporción vertical 9:16 */
        .custom-embed-9by16 {
            position: relative;
            width: 100%;
            padding-bottom: 120%;
            /* (16/9) * 100 = 177.77% */
            height: 0;
        }

        .custom-embed-9by16 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }


        /*PARA EL BOTON DE LOS 3 PUNTITOS*/
        .dropdown-toggle {
            background: white;
            border: none;
        }

        .dropdown-toggle::after {
            display: none;
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

                    <!-- Contenido Principal -->
                    <div class="content">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1>{{ $carpeta->nombre }}</h1>
                            <div>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#subirModal">
                                    <i class="bi bi-upload"></i> Subir archivos
                                </button>
                                <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#newFolderModal">
                                    <i class="bi bi-folder-fill text-warning"></i> Nueva carpetas
                                </button>
                            </div>

                        </div>

                        <hr>
                        <!-- Sección de Carpetas -->
                        <div class="row" id="carpetas">
                            <!-- Repite este bloque de código para cada carpeta -->

                            @forelse ($carpeta->children as $carpetaH)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12" id="carpeta-{{ $carpetaH->id }}">
                                    <div class="folder-card text-dark d-flex align-items-center py-2 pr-0">
                                        <!-- Agregada clase de padding para un mejor espaciado -->
                                        <div class="col-2 d-flex justify-content-center">
                                            <!-- Alinear el ícono al centro -->
                                            <i class="bi bi-folder-fill display-4"></i>
                                        </div>

                                        <!-- Centrar el texto -->
                                        <a href="{{ route('mostrar.subcarpeta', $carpetaH->id) }}"
                                            class="text-dark text-decoration-none col-8 text-center"
                                            title="Ir a la carpeta">
                                            <span>{{ $carpetaH->nombre }}</span>
                                        </a>


                                        <div class="col-2 d-flex justify-content-end"> <!-- Alinear a la derecha -->
                                            <div class="btn-group">
                                                <button class="dropdown-toggle text-dark text-decoration-none"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                    <a href="" class="dropdown-item" type="button"
                                                        data-toggle="modal" data-target="#renameFolder"
                                                        data-idcarpeta="{{ $carpetaH->id }}"
                                                        data-nombrecarpeta="{{ $carpetaH->nombre }}">
                                                        <i class="bi bi-pencil" style="font-size: 1rem;"></i>
                                                        <!-- Añade margen y ajusta el tamaño -->
                                                        Cambiar nombre
                                                    </a>
                                                    <a href="" class="dropdown-item" type="button"
                                                        onclick="eliminarCarpeta('{{ $carpetaH->id }}')">
                                                        <i class="bi bi-trash" style="font-size: 1rem;"></i>
                                                        <!-- Añade margen y ajusta el tamaño -->
                                                        Eliminar
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @empty
                            @endforelse
                            <hr>



                            <div class="card container-fluid pt-3">

                                <table class="table table-bordered text-center table-hover" id="archivos">
                                    <thead>
                                        <tr>
                                            <th>NOMBRE</th>
                                            <th>FECHA DE MODIFICACION</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $file)
                                            <tr id="file-row-{{ $file->id }}">
                                                <td class="text-center my-0 pt-2 pb-0">
                                                    <a href="" title="Ver archivo" data-toggle="modal"
                                                        data-target="#verArchivo{{ $file->id }}" class="text-dark">
                                                        @php
                                                            $ext = strtolower(
                                                                collect(explode('.', $file->nombre))->last(),
                                                            );
                                                        @endphp
                                                        @if ($ext == 'pdf')
                                                            <i class="fas fa-file-pdf text-danger">
                                                            @elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'bmp']))
                                                                <i class="fas fa-file-image text-info">
                                                                @elseif (in_array($ext, ['docx', 'doc']))
                                                                    <i class="fas fa-file-word text-primary">
                                                                    @elseif (in_array($ext, ['xls', 'xlsx']))
                                                                        <i class="fas fa-file-excel text-success">
                                                                        @else
                                                                            <i class="fas fa-file">
                                                        @endif
                                                        </i> {{ $file->nombre }}
                                                    </a>
                                                    <div class="modal fade" id="verArchivo{{ $file->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">

                                                                <div class="modal-body p-1 bg-dark">
                                                                    <!-- Imagen que ocupará todo el modal -->
                                                                    @if ($ext == 'pdf')
                                                                        <div
                                                                            class="embed-responsive custom-embed-9by16">
                                                                            <iframe
                                                                                src="{{ asset('/storage/' . $file->descripcion) }}"
                                                                                class="embed-responsive-item"></iframe>
                                                                        </div>
                                                                    @elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'bmp']))
                                                                        <img src="{{ asset('/storage/' . $file->descripcion) }}"
                                                                            alt="Imagen de ejemplo"
                                                                            class="img-fluid w-100">
                                                                    @elseif (in_array($ext, ['docx', 'doc']))
                                                                        <a href="{{ asset('/storage/' . $file->descripcion) }}"
                                                                            download
                                                                            class="d-flex flex-column align-items-center justify-content-center text-center m-4">
                                                                            <i
                                                                                class="fas fa-file-word text-primary fa-5x"></i>
                                                                            <p class="text-light">{{ $file->nombre }}
                                                                            </p>
                                                                            <p
                                                                                class="text-light border border-primary rounded mt-3 bg-primary py-1 px-2">
                                                                                Descargar archivo Word</p>
                                                                        </a>
                                                                    @elseif (in_array($ext, ['xls', 'xlsx']))
                                                                        <a href="{{ asset('/storage/' . $file->descripcion) }}"
                                                                            download
                                                                            class="d-flex flex-column align-items-center justify-content-center text-center m-4">
                                                                            <i
                                                                                class="fas fa-file-excel text-success fa-5x"></i>
                                                                            <p class="text-light">{{ $file->nombre }}
                                                                            </p>
                                                                            <p
                                                                                class="text-light border border-success rounded mt-3 bg-success py-1 px-2">
                                                                                Descargar archivo Excel</p>
                                                                        </a>
                                                                    @else
                                                                        <i class="fas fa-file">
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-auto my-0 py-1">
                                                    <span>2023/20/20 12:00</span>
                                                </td>
                                                <td class="col-auto my-0 py-1">
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm text-success" title="Asignar HR"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <i
                                                                class="fas fa-edit text-secondary my-0 py-0"></i></button>

                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">

                                                            <a class="dropdown-item" type="button"
                                                                data-toggle="modal" data-target="#renameItem"
                                                                data-iditem="{{ $file->id }}"
                                                                data-nombreitem="{{ collect(explode('.', $file->nombre))->first() }}"
                                                                data-extitem ="{{ collect(explode('.', $file->nombre))->last() }}">
                                                                <i class="bi bi-pencil"></i>
                                                                Cambiar Nombre
                                                            </a>
                                                            <a class="dropdown-item" type="button"
                                                                data-toggle="modal" data-target="#HRexterna">

                                                                <!-- Añade margen y ajusta el tamaño -->
                                                                *** Mas opciones
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <a href="" title="Eliminar"
                                                        onclick="eliminarArchivo('{{ $file->id }}')">
                                                        <i class="fas fa-trash text-danger my-0 py-0"></i> </a>
                                                </td>
                                            </tr>


                                        @empty
                                            <p class="text-secondary text-center my-0 py-0"><i
                                                    class="fas fa-volleyball-ball "></i> No hay documentos aqui</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>



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

        <!-- Modal para Crear Nueva Carpeta -->
        <div class="modal fade" id="newFolderModal" tabindex="-1" aria-labelledby="newFolderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newFolderModalLabel">Nueva Carpeta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <form id="carpetaForm">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" value="{{ $carpeta->id }}" id="id" name="id">
                                <label for="folderName" class="form-label">Nombre de la carpeta</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Subir archivos-->
        <div class="modal fade" id="subirModal" tabindex="" aria-labelledby="subirModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newFolderModalLabel">Subir Archivos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <form id="filesForm" action="{{ route('items.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="{{ $carpeta->id }}" id="id" name="id">
                            <div id="drop-area">
                                <p>Arrastra y suelta archivos aquí o haz clic para seleccionar archivos</p>
                                <input type="file" id="file" name="files[]" accept="image/*,application/*"
                                    multiple style="display:none;">
                                <div id="preview" style="font-size: 12px;"></div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Subir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para cambiar nombre a las carpetas -->
        <div class="modal fade" id="renameFolder" tabindex="-1" aria-labelledby="newFolderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newFolderModalLabel">Renombrar Carpetaa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <form id="carpetaRenameForm">
                            @csrf
                            <div class="mb-3">
                                <input type="text" id="idCarpeta" name="idCarpeta">
                                <label for="folderName" class="form-label">Nombre de la carpeta</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para cambiar nombre a las archivos -->
        <div class="modal fade" id="renameItem" tabindex="-1" aria-labelledby="newFolderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newFolderModalLabel">Renombrar Carpeta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <form id="itemForm">
                            @csrf
                            <div class="mb-3">
                                <input type="text" id="idItem" name="idItem">
                                <input type="text" id="extItem" name="extItem">
                                <label for="folderName" class="form-label">Nombre de la carpeta</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal-salir />
    <!--SCRIPTS -->


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <script>
        $('#archivos').DataTable();
    </script>


    @if (session('mensaje'))
        <script>
            let mensaje = "{{ session('mensaje') }}";
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        {{ Session::forget('mensaje') }}
    @endif



    <script>
        document.getElementById('carpetaForm').addEventListener('submit', function(event) {
            var form = this;
            var submitButton = form.querySelector('button[type=submit]');
            if (submitButton.dataset.submitting) {
                event.preventDefault();
                return;
            }
            submitButton.dataset.submitting = 'true';
        });
    </script>


    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('carpetaRenameForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar que el formulario se envíe de manera tradicional

            // Crear un objeto FormData con los datos del formulario
            let formData = new FormData(this);

            // Obtener la URL de la ruta de envío
            let url = "{{ route('registrar.carpeta') }}";

            // Token CSRF
            let token = "{{ csrf_token() }}";

            // Enviar el formulario con fetch
            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token, // Asegurarse de enviar el token CSRF
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Aquí puedes manejar la respuesta del servidor
                    //alert('Carpeta creada exitosamente');
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Algo salió mal');
                });
        });
        document.getElementById('itemForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar que el formulario se envíe de manera tradicional

            // Crear un objeto FormData con los datos del formulario
            let formData = new FormData(this);

            // Obtener la URL de la ruta de envío
            let url = "{{ route('items.store') }}";

            // Token CSRF
            let token = "{{ csrf_token() }}";

            // Enviar el formulario con fetch
            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token, // Asegurarse de enviar el token CSRF
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Aquí puedes manejar la respuesta del servidor
                    //alert('Carpeta creada exitosamente');
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Algo salió mal');
                });
        });

        document.getElementById('carpetaForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar que el formulario se envíe de manera tradicional

            // Crear un objeto FormData con los datos del formulario
            let formData = new FormData(this);

            // Obtener la URL de la ruta de envío
            let url = "{{ route('registrar.carpeta') }}";

            // Token CSRF
            let token = "{{ csrf_token() }}";

            // Enviar el formulario con fetch
            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token, // Asegurarse de enviar el token CSRF
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Aquí puedes manejar la respuesta del servidor
                    //alert('Carpeta creada exitosamente');
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Carpeta creada exitosamente.",
                        showConfirmButton: false,
                        timer: 1000
                    });

                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Algo salió mal');
                });
        });

        function eliminarArchivo(id) {
            event.preventDefault();

            Swal.fire({
                title: "¿Estas seguro?",
                text: "¡No podrás revertir esto.!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d00",
                cancelButtonColor: "#595959",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, ¡borrar esto!"
            }).then((result) => {
                if (result.isConfirmed) {


                    /*Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });*/
                    let url = "{{ route('archivo.eliminar', '') }}" + "/" + id;

                    let token = "{{ csrf_token() }}";

                    console.log(url, token);

                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token // Asegurarse de enviar el token CSRF
                            },
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            console.log(data);
                            const row = document.getElementById(
                                `file-row-${id}`); // Asumiendo que la fila tiene este ID

                            if (row) {
                                row.remove(); // Elimina la fila de la tabla

                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Tu archivo fue eliminado.",
                                    showConfirmButton: false,
                                    timer: 1000
                                });

                            }
                        })

                        .catch((error) => {
                            console.log(error);
                            alert("Algo salio mal");
                        })
                }
            });



        }

        function eliminarCarpeta(id) {
            event.preventDefault();
            Swal.fire({
                title: "¿Estas seguro?",
                text: "¡No podrás revertir esto.!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d00",
                cancelButtonColor: "#595959",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, ¡borrar esto!"
            }).then((result) => {
                if (result.isConfirmed) {

                    let url = "{{ route('carpeta.eliminar', '') }}" + "/" + id;

                    let token = "{{ csrf_token() }}";

                    console.log(url, token);

                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token // Asegurarse de enviar el token CSRF
                            },
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            console.log(data);
                            const elemento = document.getElementById(
                                `carpeta-${id}`); // Asumiendo que la fila tiene este ID
                            if (elemento) {
                                elemento.remove(); // Elimina la fila de la tabla
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Tu carpeta fue eliminado.",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                        })

                        .catch((error) => {
                            console.log(error);
                            alert("Algo salio mal");
                        })
                }
            });
        }
    </script>

    <script>
        $('#renameFolder').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var idCarpeta = button.data('idcarpeta'); // Obtener el id de carpeta desde el atributo data-*
            var nombreCarpeta = button.data('nombrecarpeta');
            console.log(idCarpeta);

            var modal = $(this); // Referencia al modal
            modal.find('#idCarpeta').val(idCarpeta); // Asignar el id al campo oculto en el modal
            modal.find('#nombre').val(nombreCarpeta);

        });

        $('#renameItem').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var idItem = button.data('iditem'); // Obtener el id de carpeta desde el atributo data-*
            var nombreItem = button.data('nombreitem');
            var extItem = button.data('extitem');
            console.log(idItem);

            var modal = $(this); // Referencia al modal
            modal.find('#idItem').val(idItem); // Asignar el id al campo oculto en el modal
            modal.find('#nombre').val(nombreItem);
            modal.find('#extItem').val(extItem);
        });
    </script>

    <!-- Script para manejar la subida de archivos -->
    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file');
        const preview = document.getElementById('preview');
        let dataTransfer = new DataTransfer();

        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', () => {
            const files = fileInput.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                dataTransfer.items.add(files[i]);
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';

                    let imagePath = '';
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        previewItem.appendChild(img);
                    } else if (file.type === 'application/pdf') {
                        const embed = document.createElement('embed');
                        embed.src = e.target.result;
                        embed.type = 'application/pdf';
                        embed.width = '200';
                        embed.height = '200';
                        previewItem.appendChild(embed);
                    } else if (file.type === 'application/msword' || file.type ===
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        imagePath = '{{ asset('imgs/word.png') }}';
                    } else if (file.type === 'application/vnd.ms-excel' || file.type ===
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                        imagePath = '{{ asset('imgs/excel.png') }}';
                    } else {
                        previewItem.textContent = 'Archivo no soportado para previsualización.';
                    }

                    if (imagePath) {
                        const img = document.createElement('img');
                        img.src = imagePath;
                        img.style.maxWidth = '200px';
                        img.style.maxHeight = '200px';
                        previewItem.appendChild(img);
                    }

                    const fileName = document.createElement('span');
                    fileName.className = 'file-name';
                    if (file.name.length > 15)
                        fileName.textContent = file.name.substr(0, 15) + "...";
                    else
                        fileName.textContent = file.name;
                    previewItem.appendChild(fileName);

                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-btn';
                    removeBtn.textContent = 'X';
                    removeBtn.onclick = function() {
                        previewItem.remove();
                        removeFile(file);
                    };
                    previewItem.appendChild(removeBtn);
                    preview.appendChild(previewItem);
                };

                reader.readAsDataURL(file);
            }

            fileInput.files = dataTransfer.files;
        }

        function removeFile(file) {
            dataTransfer = new DataTransfer();
            const files = fileInput.files;

            for (let i = 0; i < files.length; i++) {
                if (files[i] !== file) {
                    dataTransfer.items.add(files[i]);
                }
            }

            fileInput.files = dataTransfer.files;
        }
    </script>



</body>

</html>
