<?php

namespace App\Http\Controllers\carpetas;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarpetaController extends Controller
{
    //
    public function mostrar()
    {
        $carpetas = Folder::whereNull('carpeta_padre_id')->get();
        return view('carpetas.carpeta', compact('carpetas'));
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);


        //return response()->json($request,200);

        //$user = User::all();
        //return response()->json(['message' => 'Carpeta creada exitosamente.'], 200);

        //return $request;
        if ($request->idCarpeta) {
            $carpeta = Folder::find($request->idCarpeta);
            $carpeta->nombre = $request->get('nombre');
            $carpeta->save();

            return response()->json(['message' => 'Nombre de carpeta actualizado exitosamente.'], 200);

            return back()->with('mensaje', 'Nombre de carpeta actualizado exitosamente.');
        } else {
            $carpeta = new Folder();
            $carpeta->nombre = $request->get('nombre');
            $carpeta->carpeta_padre_id = $request->get('id');
            $carpeta->idUsuario = Auth::user()->idUsuario;
            $carpeta->save();

            return response()->json(['message' => 'Carpeta creada exitosamente fetch.','id' => $carpeta->id, 'nombre' => $carpeta->nombre ], 200);

            return back()->with('mensaje', 'Carpeta creada exitosamente.');
        }

        return $request;
    }

    public function mostrarSubcarpeta($id)
    {
        $carpeta = Folder::find($id);
        //$items=Item::all();
        $items = Item::where('carpeta_padre_id', $id)->get();

        //return $items;
        //$items = Item::where('carpeta_padre_id',Auth::user->idUsuario)->get();
        return view('carpetas.subcarpeta', compact('carpeta', 'items'));
    }


    public function eliminar($id){
        $folder = Folder::find($id);

        //return $archivo;

        //return response()->json($archivo);

        if ($folder) {
            $folder->delete();
            return response()->json(['message' => 'Carpeta eliminada correctamente'], 200);
        }

        return response()->json(['message' => 'Carpeta no encontrado'], 404);
    }
}
