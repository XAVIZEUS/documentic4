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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/virtual-select.min.css') }}">

    
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
    </style>

    <x-estilos-files/>
    

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
                <div class="container">

                    <!-- Contenido del Formulario -->

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="font-weight-bold text-success h1  mb-4">SEGUIMIENTO</h1>
                                        </div>
                                        <form class="user" action="{{ route('crear.seguimiento') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <i class="fas fa-fw"></i>
                                            <h4 class="text-center">HR-{{($hr->tipo==2 ? 'I-':'').$hr->idHruta}} </h4>
                                            <hr>
                                            <div class="form-group row">
                                                <!-- originado por-->        
                                                <input type="hidden" name="user" id="user" class="form-control rounded-pill" value="{{Auth::user()->idUsuario}}">
                                                <input type="hidden" name="idhr" id="idhr" class="form-control rounded-pill" value="{{$hr->idHruta}}">
                                                <input type="hidden" name="ids" id="ids" class="form-control rounded-pill" value="{{$seg->idSeguimiento}}">

                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label class="form-label">Derivado por: </label>
                                                    <input type="text" class="form-control rounded-pill"
                                                        id="deriv_por" name="deriv_por" value={{Auth::user()->usuario }} required readonly>
                                                </div>

                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="">Derivar a: (Oficina: {{ $hr->idOficina }} )</label>
                                                    <input type="hidden" name="ofi" id="ofi" class="form-control rounded-pill" value="{{$hr->idOficina}}">
                                                    <select class="form-control form-select rounded-pill" name="deriv_a" id="deriv_a">
                                                        <option class="text-center" value=""> Visible para Todos </option>
                                                        @foreach ($users_ofi as $user)
                                                            @if ($user->idUsuario == $seg->derivado_a)
                                                                <option class="text-center" value="{{ $user->idUsuario }}" selected>
                                                                    {{ $user->usuario.' - '.$user->work->nombre }}</option>
                                                            @else
                                                                <option class="text-center" value="{{ $user->idUsuario }}">
                                                                {{ $user->usuario.' - '.$user->work->nombre }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label class="form-label" for="idOficina">Proveido:</label>
                                                    <input type="text" class="form-control rounded-pill"
                                                        id="proveido" name="proveido" value="{{ $seg->proveido }}" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label class="form-label">Observacion (opcional): </label>
                                                    <input type="text" class="form-control rounded-pill"
                                                        id="obs" name="obs" value="{{ $seg->observacion }}">
                                                </div>
                                                
                                            </div>
                                            <hr>                                            
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="">Accion a realizar: </label>
                                                    <select class="form-control form-select rounded-pill" name="accion" id="accion">
                                                        @foreach ($acciones as $accion)
                                                            @if ($seg->idAccion == $accion->idAccion)
                                                                <option class="text-center" value="{{ $accion->idAccion }}" selected> {{ $accion->nombre }}</option>
                                                            @else
                                                                <option class="text-center" value="{{ $accion->idAccion }}"> {{ $accion->nombre }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                @if($seg->idSeguimiento)
                                                    <table class="table table-bordered text-center">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" colspan="2">Documentos adjuntos</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($seg->documents as $documento)
                                                                <tr class="d-flex">
                                                                    <td class="col">
                                                                        <a href="{{ route('documento.ver', $documento->idDocumento) }}" target="_blank" class="text-black">
                                                                            @php
                                                                                $ext = strtolower(collect(explode('.', $documento->nombre))->last());
                                                                            @endphp
                                                                            @if ($ext=="pdf")
                                                                                <i class="fas fa-file-pdf text-danger">
                                                                            @elseif (in_array($ext, ['jpg','jpeg','png','bmp']) ) 
                                                                                <i class="fas fa-file-image text-info">
                                                                            @elseif (in_array($ext, ['docx','doc'])) 
                                                                                <i class="fas fa-file-word text-primary">
                                                                            @elseif (in_array($ext, ['xls','xlsx'])) 
                                                                                <i class="fas fa-file-excel text-success">
                                                                            @else
                                                                                <i>sin extencion
                                                                            @endif
                                                                            </i> {{$documento->nombre }}</a><br>
                                                                    </td>
                                                                    <td class="col-auto">
                                                                        <a href="{{ route('documento.quitar', $documento->idDocumento) }}"  title="Quitar documento">
                                                                            <i class="fas fa-trash text-danger"></i> </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <td class="text-center">No se encontraron documentos.</td>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                @endif
                                                <div class="col-sm-12">
                                                    <label for="">Adjuntar archivos (opcional): </label>
                                                    <div id="drop-area">
                                                        <p>Arrastra y suelta archivos aquí o haz clic para seleccionar archivos</p>
                                                        <input type="file" id="file" name="files[]" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx" multiple style="display:none;">
                                                        <div id="preview" style="font-size: 12px;"></div>
                                                    </div>
                                                </div>                      
                                                
                                            </div>
                                            <hr>
                                            <button type="submit" class="btn btn-success btn-user btn-block">Derivar</button>
                                        </form>
                                    </div>
                                    <!-- MENSAJES -->

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <!-- FIN MENSAJES -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->



            </div>
            <!-- end main content-->
            <x-footer />


        </div>
        <!-- Fin Content wraper-->

    </div>
    <!-- final capa superior-->


    <!-- Logout Modal-->
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

                reader.onload = function (e) {
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
                    } else if (file.type === 'application/msword' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        imagePath = '{{asset("imgs/word.png")}}';
                    }else if (file.type === 'application/vnd.ms-excel' || file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                        imagePath = '{{asset("imgs/excel.png")}}';
                    }else {
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
                    if(file.name.length>15)
                        fileName.textContent = file.name.substr(0, 15)+"...";
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
