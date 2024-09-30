<!-- Sidebar -->
<ul class="navbar-nav bg-custom sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-custom-brand" href="{{ route('admin')}}">
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

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>AJUSTES</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('admin.gestionUser') }}">Gestion de usuarios</a>
                <a class="collapse-item" href="{{ route('admin.registrarUser') }}">Registrar usuario</a>
                <a class="collapse-item" href="utilities-border.html">Asignar Accesos</a>
                <a class="collapse-item" href="utilities-animation.html">Politicas de Seguridad</a>
                <hr class="sidebar-divider" style="background-color: #000000;">
                <a class="collapse-item" href="{{ route('admin.regionales') }}">Regionales</a>
                <a class="collapse-item" href="{{ route('admin.oficinas') }}">Oficinas</a>
                <a class="collapse-item" href="{{ route('admin.cargos') }}">Cargos</a>
                <a class="collapse-item" href="{{ route('admin.acciones') }}">Acciones</a>
                <a class="collapse-item" href="{{ route('admin.roles') }}">Roles</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        opciones
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('repositorio')}}">          
            <i class="fas fa-folder"></i>
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
                <a class="collapse-item" href="{{route('ventanilla.tramite')}}">Cartas</a>
                <a class="collapse-item" href="{{route('ventanilla.tramite')}}">Informes</a>
                <a class="collapse-item" href="{{route('ventanilla.tramite')}}">Memmorandums</a>
                <a class="collapse-item" href="{{route('ventanilla.tramite')}}">SIUUU</a>
            </div>
        </div>
        
    </li>

    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>REPORTESs</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{asset('img/undraw_rocket.svg')}}" alt="...">
        <p class="text-center mb-2"><strong>UNIBROSA</strong> is packed with premium features, components, and more!</p>
        <!--<a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>-->
    </div>

</ul>
<!-- End of Sidebar -->