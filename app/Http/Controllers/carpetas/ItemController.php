<?php

namespace App\Http\Controllers\carpetas;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    //

    public function verArchivo($idItem){
        $item = Item::find($idItem);
        $archivo = substr($item->url_ruta,7);
        if (Storage::disk('public')->exists($archivo)) {
            //return 'siu';
            return response()->file(storage_path("app/{$item->descripcion}"));
        }else {
            return redirect()->route('404');
        }
    }
    public function store(Request $request){
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:20000',
        ]);

        //return response()->json(['message' => 'esto esta rico'], 200);

        //return $request;
        if ($request->idItem) {
            $archivo = Item::find($request->idItem);
            $archivo->nombre = $request->get('nombre').'.'.$request->get('extItem');
            $archivo->save();

            return response()->json(['message' => 'Nombre del archivo actualizado exitosamente.'], 200);

            //return back()->with('mensaje', 'Nombre del archivo actualizado exitosamente.');
        }
        // Recorrer los archivos subidos
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $fileName = $file->getClientOriginalName();

                    $path = $file->storeAs('drive', $fileName,'public');

                    DB::table('items')->insert([
                        'nombre' => $fileName,
                        'descripcion' => $path,
                        'carpeta_padre_id' => $request->id,
                        'idUsuario' => Auth::user()->idUsuario,
                    ]);
                } else {
                    return back()->withErrors(['file' => 'Hubo un error subiendo el archivo.']);
                }
            }
        } else {
            return back()->withErrors(['file' => 'No se ha subido ningún archivo.']);
        }
        return redirect()->back();
    }

    public function eliminar($id){
        $archivo = Item::find($id);

        //return $archivo;

        //return response()->json($archivo);

        if ($archivo) {

            if (Storage::exists($archivo->descripcion)) {
                Storage::delete($archivo->descripcion);
            }
            $archivo->delete();
            return response()->json(['message' => 'Archivo eliminado correctamente'], 200);
        }

        return response()->json(['message' => 'Archivo no encontrado'], 404);
    }


}
