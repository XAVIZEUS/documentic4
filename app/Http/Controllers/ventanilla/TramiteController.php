<?php

namespace App\Http\Controllers\ventanilla;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Action;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Office;
use App\Models\Roadmap;
use App\Models\Tracking;
use App\Models\User;
use COM;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Storage;

class TramiteController extends Controller
{
    //

    public function verTramite()
    {
        $oficinas = Office::all();
        return view('ventanilla.crearHojaRuta', compact('oficinas'));
    }

    public function crearCliente(Request $cli){
        $cliente = new Customer();
        $cliente->nombre = $cli->nombres;
        $cliente->cargo = $cli->cargoR;
        $cliente->institucion = $cli->institucion;
        $cliente->telefono = $cli->telefono;
        $cliente->ciudad = "La Paz - El ALto";
        $cliente->direccion = "Zona Villa FFFF, Av. Buenos Aires, Calle X";
        $cliente->save();
        return;
    }

    public function crearHojaRuta(Request $request)
    {
        $this->crearCliente($request);
        $hr_last = Roadmap::latest()->first();
        $hr = new Roadmap();

        $hr->idUsuario = $request->user;
        $hr->codigo = '102039';
        $hr->f_creacion = now();
        $hr->tipo = Auth::user()->roles->first()->idRol == 3 ? 1 : 2;
        $hr->estado = 0; //0:en proceso  1:Archivado
        $hr->referencia = $request->ref;
        $hr->remitente = $request->nombres;
        $hr->cargo_remitente = $request->cargoR? $request->cargoR : 'Ninguno';
        $hr->instituto_remitente = $request->institucion? $request->institucion : 'Ninguno';
        $hr->idOficina = $request->ofi;

        if (!is_null($hr_last)) {
            if (intdiv(($hr_last->idHruta), 100000) != date('Y')) {
                $hr->idHruta = (int) (date('Y') . '00000');
            }
        } else {
            $hr->idHruta = (int) (date('Y') . '00000');
        }
        $hr->save();
        $hr_actual = Roadmap::latest()->first();

        $seguimiento = new Tracking();
        session(['hr' => $hr_actual,'seg' => $seguimiento]);

        return redirect()->route('realizar.seguimiento')->with('idU', $request->user);
    }

    public function clientesRemitente(Request $request){
        $term = $request->term;

        $clientes = Customer::where('nombre', 'like', '%'.$term.'%')->get();
        $datos = [];
        foreach ($clientes as $cliente) {
            $datos[] = [
                'label' => $cliente->nombre, 'cargo' => $cliente->cargo, 'institucion' => $cliente->institucion, 'telefono' => $cliente->telefono
            ];
        }

        return $datos;
    }

    //al hacer click en derivar
    public function continuarSeguimiento(Request $request)
    {
        $hr_actual = Roadmap::find($request->idh);
        $hr_actual->idOficina = $request->ofi;
        $hr_actual->save();

        $seguimiento = new Tracking();
        $idsegActual = $request->idSeg;
        //return $idsegActual;
        session(['hr' => $hr_actual,'seg' => $seguimiento, 'segActual'=>$idsegActual]);
        return redirect()->route('realizar.seguimiento');
        //return redirect()->back();
    }
    public function derivar($idSeg){
        $segActual = Tracking::find($idSeg);
        $segActual->estado = 3;
        $segActual->save();
    }

    public function corregirSeguimiento(Request $request){
        $hr_actual = Roadmap::find($request->idh);
        $hr_actual->idOficina = $request->ofi;
        $hr_actual->save();

        $seguimiento = Tracking::find($request->idSeg);
        session(['hr' => $hr_actual,'seg' => $seguimiento]);
        return redirect()->route('realizar.seguimiento');
    }

    public function eliminarSeguimiento(Request $request) {
        $ids = $request->idSeg1;
        Tracking::find($ids)->delete();

        return redirect()->back();
    }


    //seguimiento
    public function formSeguimiento(){
        $hr = session('hr');
        $seg = session('seg');

        //return $hr->idOficina;

        $ofi = $hr->idOficina;
        $users_ofi = User::where('idUsuario','<>','1')
                        ->where('idUsuario','<>',Auth::user()->idUsuario)
                        ->where('idOficina', $ofi)
                        ->with('work')->get();
        $acciones = Action::all();

        //$documents = Document::all();

        return view('usuario.seguimiento', compact('users_ofi', 'hr', 'acciones', 'seg',));
    }

    public function crearSeguimiento(Request $req){
        if($req->ids){
            $seguimiento = Tracking::find($req->ids);
            $seguimiento->f_recepcion = NULL;
            //$this->subirArchivos($req, $seguimiento);
        }else{

            $seguimiento = new Tracking();
            $oldSeg = session('segActual');
            if ($oldSeg)
                $this->derivar($oldSeg);
        }
        $seguimiento->derivado_por = $req->user;
        if($req->deriv_a){
            $seguimiento->observacion = $req->obs;
        }else{
            $seguimiento->observacion = $req->ofi;
        }
        $seguimiento->derivado_a = $req->deriv_a;
        $seguimiento->f_derivacion = now();
        //$seguimiento->f_recepcion = '00-01-01';
        $seguimiento->proveido = $req->proveido;

        $seguimiento->idHruta = $req->idhr;
        $seguimiento->idAccion = $req->accion;
        $seguimiento->estado =  0; //no recibido
        $seguimiento->tipo = 0; //0:original, 1:copia
        $seguimiento->save();


        $this->subirArchivos($req, $seguimiento);
        return redirect()->route('bandeja.salida');
    }



    public function subirArchivos(Request $request, $seg){
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:20000',
        ]);

        // Recorrer los archivos subidos
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Guardar el archivo en la carpeta 'uploads' en el disco 'public'
                    $fileName = $file->getClientOriginalName();

                    $path = $file->storeAs('public/documentosHR/HR' . $request->idhr, $fileName);
                    //$path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

                    DB::table('documents')->insert([
                        'idSeguimiento' => $seg->idSeguimiento,
                        'nombre' => $fileName,
                        'f_creacion' => date('Y-m-d'),
                        'url_ruta' => $path,
                    ]);
                } else {
                    return back()->withErrors(['file' => 'Hubo un error subiendo el archivo.']);
                }
            }
        } else {
            return back()->withErrors(['file' => 'No se ha subido ningún archivo.']);
        }


        //return back()->with('success', 'Los archivos han sido subidos con éxito.')->with('files', $uploadedFilePaths);
    }

    public function verDocumento($idDocumento){
        $documento = Document::find($idDocumento);

        $archivo = substr($documento->url_ruta,7);

        if (Storage::disk('public')->exists($archivo)) {
            //return 'siu';
            return response()->file(storage_path("app/{$documento->url_ruta}"));
        }else {
            return redirect()->route('404');
        }
    }

    public function confirmarDocumento(Request $request){
        $confirmado = $request->has('confirmar');
        // Lógica para procesar la confirmación
        if ($confirmado) {
            $seg = Tracking::find($request->idSeguimiento);
            $seg->estado = 1;
            //$seg->f_recepcion = now();
            $seg->save();
        }
        return $this->bEntrada();
    }

    public function quitarDocumento($idDocumento){
        // Encontrar el documento en la base de datos
        $documento = Document::find($idDocumento);
        $idSeg = $documento->idSeguimiento;

        if ($documento) {
            // Obtener la ruta del archivo desde la base de datos
            $archivo = substr($documento->url_ruta,7);
            // Verificar si el archivo existe
            if (Storage::disk('public')->exists($archivo)) {
                // Eliminar el archivo
                Storage::disk('public')->delete($archivo);

                // Eliminar el registro de la base de datos
                $documento->delete();
                $seguimiento = Tracking::find($idSeg);
                session(['seg'=>$seguimiento]);

                return redirect()->back()->with('success', 'Documento eliminado con éxito.');
            } else {
                return redirect()->back()->withErrors('El archivo no existe en el almacenamiento.');
            }
        } else {
            return redirect()->back()->withErrors('Documento no encontrado.');
        }
    }


    public function bEntrada(){
        $seguimientos = Tracking::where('derivado_a', Auth::user()->idUsuario)
                        ->where(function ($query) {
                            $query->where('estado', 0)
                                ->orWhere('estado', 1);
                        })
                        ->with('derivador', 'actions', 'derivadoA', 'documents','roadmaps')->get();
        //return $seguimientos;
        return view('usuario.bandeja_entrada', compact('seguimientos'));
    }

    public function recibir(Request $request){
        $seg = Tracking::find($request->ids);
        $seg->estado = 2;
        $seg->f_recepcion = now();
        $seg->save();
        return $this->bPendiente();
    }

    public function devolver(Request $req){
        $old_seguimiento = Tracking::find($req->idSeguimiento)->load('documents');
        $this->derivar($req->idSeguimiento);

        $seguimiento = new Tracking();
        $seguimiento->derivado_por = Auth::user()->idUsuario;
        $seguimiento->derivado_a = $old_seguimiento->derivado_por;
        $seguimiento->f_derivacion = now();
        //$seguimiento->f_recepcion = '00-01-01';
        $seguimiento->proveido = $req->motivo;
        $seguimiento->observacion = 'Devolucion';
        $seguimiento->idHruta = $old_seguimiento->idHruta;
        $seguimiento->idAccion = $old_seguimiento->idAccion;
        $seguimiento->estado =  1; //no recibido documentos en fisico
        $seguimiento->save();

        $seg = Tracking::latest()->first();


        foreach ($old_seguimiento->documents as $document) {
            DB::table('documents')->insert([
                'idSeguimiento' => $seg->idSeguimiento,
                'nombre' => $document->nombre,
                'f_creacion' => date('Y-m-d'),
                'url_ruta' => $document->url_ruta,
            ]);
        }
        //$this->subirArchivos($req, $seg);
        //DB::table('trackings')->where('idSeguimiento', $request->ids)->delete();
        return redirect()->back();
    }


    public function bPendiente(){
        $seguimientos = Tracking::where('derivado_a', Auth::user()->idUsuario)
                        ->where('estado',2)
                        ->with('derivador', 'actions', 'derivadoA', 'documents')->get();
        //return $seguimientos;
        $oficinas = Office::all();
        return view('usuario.bandeja_pendientes', compact('seguimientos','oficinas'));
    }

    public function bSalida(){
        $seguimientos = Tracking::where('derivado_por', Auth::user()->idUsuario)
                        //->where('estado',3)
                        ->with('derivador','actions', 'derivadoA', 'documents')->get();
        $oficinas = Office::all();
        return view('usuario.bandeja_salida', compact('seguimientos','oficinas'));
    }
}
