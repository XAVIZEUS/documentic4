<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Roadmap;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HojaRutaController extends Controller{
    //
    public function repositorio(){
        $roadmaps = Roadmap::all();
        return view('admin.repositorio', compact('roadmaps'));
    }

    //admin
    public function verHojaRuta($idh){
        $hr = Roadmap::find($idh);
        $seguimientos = Tracking::where('idHruta',$idh)
                    ->with('derivador', 'actions', 'derivadoA', 'documents')->get();
        //return $segs;
        return view('usuario.verHojaRuta', compact('hr', 'seguimientos'));
    }

    //usuarios
    public function listaHruta(){
        $roadmaps = DB::table('roadmaps')
        ->join('trackings', 'trackings.idHruta', '=', 'roadmaps.idHruta')
        ->where('trackings.derivado_a', Auth::user()->idUsuario)
        ->select('roadmaps.*')
        ->distinct()
        ->get();

        //return $hojas;
        return view('usuario.hojasDeRuta', compact('roadmaps'));
        //return view('usuario.hojasDeRuta');
    }

    //editar hR
    public function actualizarHR(Request $request){
        $hr = Roadmap::find($request->idhr);

        $hr->codigo = $request->cod;
        $hr->referencia = $request->referencia;
        $hr->remitente = $request->nomRemit;
        $hr->cargo_remitente = $request->cargoRemit;
        $hr->instituto_remitente = $request->instRemit;
        $hr->save();
        return redirect()->back();
    }

    public function eliminarHR(Request $request){
        $hr = Roadmap::find($request->idhr);
        //Contar seguimientos con el id 
        $seguimientos = Tracking::where('idHruta', $hr->idHruta)->count();
        if($seguimientos > 0){
            return redirect()->back()->withErrors(['error' => 'No se puede eliminar la hoja de ruta, tiene seguimientos asociados.']);
        }
        $hr->delete();
        return redirect()->back();
    }
}
