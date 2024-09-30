<!-- Sidebar -->
<ul class="navbar-nav bg-custom sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-custom-brand" href="{{ route('index')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('img/logoU.png')}}" alt="Logo" style="max-width: 100%; height: auto;">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>SEGUIMIENTOS</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{ route('bandeja.entrada') }}">ENTRADA</a>
                <a class="collapse-item" href="{{ route('bandeja.pendientes') }}">PENDIENTES</a>
                <a class="collapse-item" href="{{ route('bandeja.salida') }}">SALIDAS</a>
            </div>
        </div>
    </li>

    @if (Auth::check() && (Auth::user()->roles->first()->idRol)==3)
        <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tramites"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>TRAMITES</span>
        </a>
        <div id="tramites" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Elegir tareas:</h6>
                <a class="collapse-item" href="{{route('ventanilla.tramite')}}">Crear Tramite</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Nav Item - Utilities Collapse Menu -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        opciones
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('listahruta.ver')}}">
            <i class="bi bi-folder-fill"></i>
            <span>REPOSITORIO</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cites" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>GENERAR CITE</span>
        </a>

        <div id="cites" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Elegir tipo de documento:</h6>
                <a class="collapse-item" href="{{route('usuario.produccion',base64_encode(1))}}">Cartas</a>
                <a class="collapse-item" href="{{route('usuario.produccion',base64_encode(2))}}">Informes</a>
                <a class="collapse-item" href="{{route('usuario.produccion',base64_encode(3))}}">Memorandums</a>
            </div>
        </div>

    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#misdocumentos" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-book"></i>
            <span>MIS DOCUMENTOS</span>
        </a>

        <div id="misdocumentos" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Elegir tipo de documento:</h6>
                <a class="collapse-item" href="{{route('usuario.asignados',base64_encode(1))}}">Asignados</a>
                <a class="collapse-item" href="{{route('usuario.borradores',base64_encode(2))}}">Borradores</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('mostrar.carpeta')}}">
            <i class="fas fa-folder-open"></i>
            <span>DRIVE XD</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2"  src="{{asset('img/undraw_rocket.svg')}}" alt="...">
        <p class="text-center mb-2"><strong>UNIBROSA</strong> is packed with premium features, components, and more!</p>
        <!--<a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>-->
    </div>

</ul>
<!-- End of Sidebar -->
