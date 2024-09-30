<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\Document;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validar que hay archivos y que cumplen con las restricciones de tipo y tamaño
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,gif,pdf,mp4|max:50000',
        ]);

        // Array para almacenar los paths de los archivos subidos
        $uploadedFilePaths = [];

        // Recorrer los archivos subidos
        foreach ($request->file('files') as $file) {
            if ($file->isValid()) {
                // Guardar el archivo en la carpeta 'uploads' en el disco 'public'
                $fileName = $file->getClientOriginalName();

                // Guardar el archivo con su nombre original en la carpeta 'uploads' dentro de 'public'
                $path = $file->storeAs('public/uploads/xd', $fileName);
                
                DB::table('documents')->insert([
                    'idSeguimiento' => 1,
                    'nombre' => $fileName,
                    'f_creacion' => now(),
                    'url_ruta' => $path,
                ]);


            } else {
                return back()->withErrors(['file' => 'Hubo un error subiendo el archivo.']);
            }
        }

        // Devolver una respuesta de éxito con los paths de los archivos subidos
        return back()->with('success', 'Los archivos han sido subidos con éxito.')->with('files', $uploadedFilePaths);
    }
}
