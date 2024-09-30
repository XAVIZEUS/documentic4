<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Office;
use App\Models\Region;
use App\Models\Work;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    //REGIONALES
    public function mostrarRegional()
    {
        $regions = Region::all();
        return view('admin.regionales', compact('regions'));
    }
    public function crearRegional(Request $request){
        
        $region = Region::find($request->idRegion);
        if (!$region) {
            //crear nueva regional
            $region = new Region();
            $region->idRegion = $request->idRegion;
        }
        $region->departamento = $request->departamento;
        $region->ubicacion = $request->ubicacion;
        $region->save();
        return redirect()->route('admin.regionales');
    }



    //OFICINAS
    public function mostrarOficina()
    {
        //$offices = Office::all();
        //$dataoffices = DataTables::of($offices)->toJson(true);
        return view('admin.oficinas');
    }

    public function dataOficina(){
        $offices = Office::all();
        return DataTables::of($offices)->toJson(true);

    }
    public function crearOficina(Request $request)
    {
        $offices = Office::find($request->idOficina);
        if (!$offices) {
            //crear nueva oficina
            $offices = new Office();
            $offices->idOficina = $request->idOficina;
        }
        $offices->nombre = $request->nombre;
        $offices->save();
        return redirect()->route('admin.oficinas');
    }

    //CARGOS
    public function mostrarCargo()
    {
        $cargos = Work::all();
        return view('admin.cargos', compact('cargos'));
    }
    public function crearCargo(Request $request){
        $cargos = Work::find($request->idCargo);
        if (!$cargos) {
            //crear nuevo cargo
            $cargos = new Work();
        }
        $cargos->nombre = $request->nombre;
        $cargos->save();
        return redirect()->route('admin.cargos');
    }

    //ACCIONES
    public function mostrarAccion(){
        $acciones = Action::all();
        return view('admin.acciones', compact('acciones'));
    }
    public function crearAccion(Request $request)
    {
        $accion = Action::find($request->idAccion);
        if (!$accion) {
            //crear nuevo cargo
            $accion = new Action();
        }
        $accion->nombre = $request->nombre;
        $accion->save();
        return redirect()->route('admin.acciones');
    }

    //ROLES
    public function mostrarRol()
    {
        $roles = Role::all();
        return view('admin.roles', compact('roles'));
    }
    public function crearRol(Request $request)
    {
        $rol = Role::find($request->idRol);
        if (!$rol) {
            //crear nuevo rol
            $rol = new Role();
        }
        $rol->nombre = $request->nombre;
        $rol->save();
        return redirect()->route('admin.roles');
    }
    


    public function eliminarRegistro(Request $request) {
        $id = $request->id;
        $tabla = $request->nombre;
        //$res = -1;
        if ($tabla == 'roles') {
            $idx = 'idRol';
            $res = DB::table('role_user')->where('Rol_id', $id)->count();
        } else if ($tabla == 'actions'){
            $idx = 'idAccion';
            $res = DB::table('trackings')->where($idx, $id)->count();            
        }else{
            if ($tabla == 'offices'){
                $idx = 'idOficina';
            } else if ($tabla == 'regions'){
                $idx = 'idRegion';
            } else if ($tabla == 'works'){
                $idx = 'idCargo';
            }
            $res = DB::table('users')->where($idx, $id)->count();
        }
        
        if ($res == 0) {
            DB::table($tabla)->where($idx, $id)->delete();
            return redirect()->back();
        } else {
            return "No se puede eliminar el registro, ya que está en uso en otras tablas: ".$res;
        }
    }

    public function dataoficia(){
        $offices = Office::all();

        return DataTables::of($offices)->toJson(true);

    }
}
