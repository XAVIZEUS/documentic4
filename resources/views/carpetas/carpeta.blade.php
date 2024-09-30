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
                            <h1 class="m-0 font-weight-bold text-primary">MI UNIDAD</h1>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#newFolderModal">
                                <i class="bi bi-folder-fill text-warning"></i> Nueva carpeta
                            </button>

                        </div>

                        <hr>
                        <!-- Sección de Carpetas -->
                        <div class="row">
                            <!-- Repite este bloque de código para cada carpeta -->

                            @forelse ($carpetas as $carpeta)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-12" id="carpeta-{{ $carpeta->id }}">
                                    <div class="folder-card text-dark d-flex align-items-center py-2 pr-0">
                                        <!-- Agregada clase de padding para un mejor espaciado -->
                                        <div class="col-2 d-flex justify-content-center">
                                            <!-- Alinear el ícono al centro -->
                                            <i class="bi bi-folder-fill display-4"></i>
                                        </div>

                                        <!-- Centrar el texto -->
                                        <a href="{{ route('mostrar.subcarpeta', $carpeta->id) }}"
                                            class="text-dark text-decoration-none col-8 text-center"
                                            title="Ir a la carpeta">
                                            <span>{{ $carpeta->nombre }}</span>
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
                                                        data-idcarpeta="{{ $carpeta->id }}"
                                                        data-nombrecarpeta="{{ $carpeta->nombre }}">
                                                        <i class="bi bi-pencil" style="font-size: 1rem;"></i>
                                                        <!-- Añade margen y ajusta el tamaño -->
                                                        Cambiar nombre
                                                    </a>
                                                    <a href="" class="dropdown-item" type="button"
                                                        onclick="eliminarCarpeta('{{ $carpeta->id }}')">
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="carpetaForm">
                            @csrf
                            <div class="mb-3">
                                <label for="folderName" class="form-label">Nombre de la carpeta</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear</button>
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
                        <h5 class="modal-title" id="newFolderModalLabel">Renombrar Carpeta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
            /* PPRUEBAS FETCH

                                    let url = "{{ route('fetch') }}";

                                    console.log(url);

                                    fetch(url)
                                        .then((response) => response.json())
                                        .then((data) => {
                                            console.log(data);

                                        })
                                        .catch((error) => {
                                            console.log(error);
                                        })*/
        </script>

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
                            timer: 1500
                        });

                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Algo salió mal');
                    });
            });

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
                                        timer: 1500
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
        </script>

    </div>
</body>

</html>
