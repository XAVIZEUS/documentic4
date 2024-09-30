<?php

use App\Http\Controllers\admin\CompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\CrudController;
use App\Http\Controllers\admin\HojaRutaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\FileUploadController;
use App\Http\Controllers\ventanilla\TramiteController;
use App\Http\Middleware\Administrador;
use App\Http\Middleware\Autenticado;
use App\Models\Tracking;

use App\Http\Controllers\carpetas\CarpetaController;
use App\Http\Controllers\carpetas\ItemController;
use App\Http\Controllers\user\documentController;
use Dompdf\FrameDecorator\Text;

Route::get('/404', function () {
    //return view('usuario.index');
    return view('404');
})->name('404');

//VISTA PRINCIPAL AL ENTRAR A LA PAGINA y CERRAR SESION
Route::get('/', function (Request $request) {
    $consulta = Company::latest()->first();
    $nombreE = $consulta->nombre;

    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    $consulta = Company::latest()->first();
    //compact($post);
    //return view('login',['post' => $consulta->nombre]);
    //return $request;
    return view('login', compact('nombreE'));
})->name('salir');

// VALIDAR INGRESO
Route::post('/login', [LoginController::class, 'login'])->name('login.ingresar');

// RUTA PARA DIGIRISE A LA VISTA ADMIN
Route::get('/admin', function () {
    //return view('usuario.index');
    return view('admin.home');
})->name('admin')->middleware([Autenticado::class,Administrador::class]);

//RUTA PARA DIRIGIRSE AL USUARIO NORMAL
Route::get('/index', function () {
    $segE = Tracking::where('derivado_a', Auth::user()->idUsuario)->where(function ($query) {
        $query->where('estado', 0)
            ->orWhere('estado', 1);
    });
    $segP = Tracking::where('derivado_a', Auth::user()->idUsuario)->where('estado',2);
    return view('usuario.index', compact('segP','segE'));
})->name('index')->middleware([Autenticado::class, Administrador::class]);

Route::get('/perfil', [LoginController::class, 'perfil'])->name('ver.perfil')->middleware(Autenticado::class);


//-------------------------------ADMIN------------------------------------------
//CRUD

Route::post('/login', [LoginController::class, 'login'])->name('login.ingresar');

Route::get('/admin/gestionUsuarios', [CrudController::class, 'listar'])->name('admin.gestionUser');

Route::get('/admin/datatable-users', [CrudController::class, 'dataTableUsers'])->name('admin.data.users');

Route::post('/users/estado-form', [CrudController::class, 'cambiarStatus'])->name('gestionuser.cambiarStatus');

Route::get('/registrar', [CrudController::class, 'registrarUsuario'])->name('admin.registrarUser');

Route::post('/users/guardar', [CrudController::class, 'guardarUsuario'])->name('guardar.usuario');

Route::get('/users/{id}/editar', [CrudController::class, 'edit'])->name('usuarios.editar');

Route::post('/users/actualizar', [CrudController::class, 'actualizar'])->name('usuarios.actualizar');

//Route::get('/usesdssds')->name('');

Route::post('/admin/eliminarRegistro', [CompanyController::class, 'eliminarRegistro'])->name('eliminar.company-data');

//REGIONALES
Route::get('/admin/regionales', [CompanyController::class, 'mostrarRegional'])->name('admin.regionales');
Route::post('/admin/crearRegional', [CompanyController::class, 'crearRegional'])->name('crear.regionales');

//OFICINAS
Route::get('/admin/oficinas', [CompanyController::class, 'mostrarOficina'])->name('admin.oficinas');
Route::get('/admin/oficinas-datos', [CompanyController::class, 'dataOficina'])->name('datatable.oficinas');
Route::post('/admin/crearOficina', [CompanyController::class, 'crearOficina'])->name('crear.oficinas');

//CARGOS
Route::get('/admin/cargos', [CompanyController::class, 'mostrarCargo'])->name('admin.cargos');
Route::post('/admin/crearCargo', [CompanyController::class, 'crearCargo'])->name('crear.cargos');

//ACCIONES
Route::get('/admin/acciones', [CompanyController::class, 'mostrarAccion'])->name('admin.acciones');
Route::post('/admin/crearAccion', [CompanyController::class, 'crearAccion'])->name('crear.acciones');

//ROLES
Route::get('/admin/roles', [CompanyController::class, 'mostrarRol'])->name('admin.roles');
Route::post('/admin/crearRol', [CompanyController::class, 'crearRol'])->name('crear.roles');

//REPOSITORIO
Route::get('/usuario/ver-hojas-ruta', [HojaRutaController::class, 'repositorio'])->name('repositorio');


//--------------------- USUARIO -------------------------

//CAMBIAR CONTRASEÑA
Route::post('/index/cambiarPassword', [UserController::class, 'cambiarPassword'])->name('usuario.cambiar');
//RESTAURAR CONTRASEÑA
Route::get('/resturarPassword/{id}', [CrudController::class, 'restaurarPassword'])->name('restaurar.contrasena');


//hojas de ruta
Route::get('/usuario/ver-hojasRuta', [HojaRutaController::class, 'listaHruta'])->name('listahruta.ver');
Route::post('/editar-hoja-ruta', [HojaRutaController::class, 'actualizarHR'])->name('editar.hojaRuta');

//Seguimientos
Route::get('/usuario/crear-seguimiento', [TramiteController::class, 'formSeguimiento'])->name('realizar.seguimiento');
//Route::post('/usuario/derivar', [TramiteController::class, 'derivar'])->name('derivar.seguimiento');
Route::post('/usuario/continuar-seg', [TramiteController::class, 'continuarSeguimiento'])->name('continuar.seguimiento');
Route::post('/usuario/corregir-seg', [TramiteController::class, 'corregirSeguimiento'])->name('corregir.seguimiento');
Route::post('/usuario/eliminar-seg', [TramiteController::class, 'eliminarSeguimiento'])->name('eliminar.seguimiento');
Route::post('/usuario/guardar-seg', [TramiteController::class, 'crearSeguimiento'])->name('crear.seguimiento');


//Bandejas
Route::get('/usuario/bandeja-entrada', [TramiteController::class, 'bEntrada'])->name('bandeja.entrada');
Route::post('/usuario/recibir', [TramiteController::class, 'recibir'])->name('bandeja.recibir');
Route::post('/usuario/devolver', [TramiteController::class, 'devolver'])->name('bandeja.devolver');


Route::get('/Usuario/bandeja-pendientes', [TramiteController::class, 'bPendiente'])->name('bandeja.pendientes');
Route::get('/Usuario/bandeja-salida', [TramiteController::class, 'bSalida'])->name('bandeja.salida');


//VER HOJA RUTA
Route::get('/usuario/{idh}/ver-hoja-ruta', [HojaRutaController::class, 'verHojaRuta'])->name('usuario.hojaRuta');

//GENERAR DOCUMENTOS ______________________PRODUCCION
Route::get('/usuario/{tipo}/elaboracion', [documentController::class, 'produccion'])->name('usuario.produccion');
Route::post('/usuario/crear-documento', [documentController::class, 'crearDocumento'])->name('usuario.crearDocumento');
Route::post('/usuario/guardar', [documentController::class, 'guardarBorrador'])->name('documento.guardar');

Route::post('/documento/editar',[documentController::class, 'editar'])->name('documento.editar');


Route::get('/usuario/borradores', [documentController::class, 'borradores'])->name('usuario.borradores');
Route::get('/usuario/asignados', [documentController::class, 'asignados'])->name('usuario.asignados');
Route::get('/usuario/destinatarios', [documentController::class, 'destinatarios'])->name('usuario.destinatarios');
Route::get('/usuario/destinatariosC', [documentController::class, 'destinatariosC'])->name('usuario.destinatariosC');






//-----------------------VENTANILLA--------------------------
Route::get('/ventanilla/Crear-tramites', [TramiteController::class, 'verTramite'])->name('ventanilla.tramite');
Route::post('/ventanilla/crearHojaRuta', [TramiteController::class, 'crearHojaRuta'])->name('crear.hojaRuta');
Route::get('/ventanilla/clientesRemitente', [TramiteController::class, 'clientesRemitente'])->name('ventanilla.clientesRemitente');

Route::post('/ventanilla/eliminarHojaRuta', [HojaRutaController::class, 'eliminarHR'])->name('eliminar.hr');



//-------------------------------------PRUEBITAS--------------------------------------
Route::get('/file', function () {
    return view('usuario.file');
});

Route::post('/upload', [FileUploadController::class, 'upload'])->name('file.upload');

Route::get('/edit', function () {
    return view('usuario.editor');
})->name('editor');

//Route::get('/generar-reporte-pendientes{id}', [PDFController::class, 'generatePDF'])->name('generar.reporte');
Route::get('/generar-reporte-salida{id}', [PDFController::class, 'generatePDF'])->name('generar.reporte');
Route::get('/generar-reporte-hoja-ruta/{id}', [PDFController::class, 'imprimirHojaRuta'])->name('reporte.hruta');


// -----------------------VER DOCUMENTO-------------------------------------
// web.php
Route::get('/documentos/ver/{id}', [TramiteController::class, 'verDocumento'])->name('documento.ver');
Route::post('/documentos/confirmar', [TramiteController::class, 'confirmarDocumento'])->name('documento.cofirmar');

Route::get('/documentos/quitar/{id}', [TramiteController::class, 'quitarDocumento'])->name('documento.quitar');

//Route::delete('/documento/quitar/{id}', [FileUploadController::class, 'quitarDocumento'])->name('documento.quitar');



Route::get('/text', [TextController::class, 'index'])->name('text');

Route::post('/export/pdf', [TextController::class, 'exportPdf'])->name('export.pdf');
Route::post('/export/word', [TextController::class, 'exportWord'])->name('export.word');



//CARPETAS
Route::get('/carpetas',[CarpetaController::class, 'mostrar'])->name('mostrar.carpeta');
Route::post('/registrar-carpeta',[CarpetaController::class, 'registrar'])->name('registrar.carpeta');
Route::get('/carpeta/{id}',[CarpetaController::class, 'mostrarSubcarpeta'])->name('mostrar.subcarpeta');
Route::get('/carpeta/eliminar/{id}',[CarpetaController::class, 'eliminar'])->name('carpeta.eliminar');
// ARCHIVOS
Route::get('/archivo/{ver}',[ItemController::class, 'verArchivo'])->name('archivo.ver');
Route::get('/archivo/eliminar/{id}',[ItemController::class, 'eliminar'])->name('archivo.eliminar');

Route::get('/prueba', function () {
    return view('ajax');
});

Route::post('/items', [ItemController::class, 'store'])->name('items.store');


Route::get('/ajax',[TextController::class, 'users'])->name('ajax');
