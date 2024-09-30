<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Make_document;
use App\Models\Type;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\Shared\Validate;

class documentController extends Controller
{
    public function destinatarios(Request $request){
        $term = $request->term;

        $destinatarios = Customer::where('nombre', 'like', '%'.$term.'%')->get();
        $datos = [];
        foreach ($destinatarios as $destinatario) {
            $datos[] = [
                'label' => $destinatario->nombre, 'cargo' => $destinatario->cargo
            ];
        }

        return $datos;
    }

    public function destinatariosC(Request $request){
        $term = $request->term;
        $destinatarios = Customer::where('nombre', 'like', '%'.$term.'%')->get();

        $datos = [];
        foreach ($destinatarios as $destinatario) {
            $datos[] = [
                'label' => strtoupper($destinatario->nombre ." || ". $destinatario->institucion)." || ". $destinatario->direccion." || ". $destinatario->telefono
            ];
        }

        return $datos;
    }


    public function borradores(){
        $borradores = Make_document::where(function ($query) {
            $query->where('estado', 0)
                ->orWhere('estado', 1);
        })->get();
        return view('usuario.borradores',compact('borradores'));
    }

    /*public function editar(Request $request){

        //return $request;
        $doc = Make_document::find($request->idDoc);
        //return $doc;
        //session(['hr' => $hr_actual,'seg' => $seguimiento]);
        $tipo = base64_encode($doc->idTipo);


        $hola = "1";
        $lista  = count(explode(',', $hola));
        return $lista;

        //return $tipo;
        return redirect()->route('usuario.produccion',$tipo)->with('doc', $doc);
    }*/

    public function editar(Request $request){

        //return $request;
        $doc = Make_document::find($request->idDoc);
        //return $doc;
        //session(['hr' => $hr_actual,'seg' => $seguimiento]);
        $tipo = base64_encode($doc->idTipo);


        //return $lista[0];

        $id = $tipo.",".$request->idDoc;


        //return $tipo;
        return redirect()->route('usuario.produccion',$id);
    }

    //asignados

    public function asignados(){
        $asignados = Make_document::where('estado',1)->get();
        return view('usuario.asignados',compact('asignados'));
    }

    //
    /*public function produccion($idTipo){
        $clientes = Customer::all();


        return view('usuario.produccion',compact('idTipo'));
    }*/

    public function produccion($idTipo){
        $clientes = Customer::all();

        $sep = explode(',', $idTipo);
        $idTipo = $sep[0];

        $doc=null;

        if(count($sep)==1){
            return view('usuario.produccion',compact('idTipo'));
        }else{
            $idDoc = $sep[1];
            $doc = Make_document::find($idDoc);

            $edit = 1;
            return view('usuario.produccion',compact('idTipo','doc','edit'));
        }
    }

    public function crearDocumento(Request $request){
        //return $request;
        if($request->idTipo ==1){
            return $this->exportPdfCarta($request);
        }else if($request->idTipo ==2){
            return $this->generarPdfInforme($request);
        } else {
            return back();
        }
    }

    //GUIARDAR BORRADOR
    public function guardarBorrador(Request $request){
        $doc = new Make_document();
        //return $request;
        $doc->idTipo = $request->idTipo;
        $doc->idUsuario = $request->user;
        $doc->depto= $request->departamento;
        $doc->fecha = date('Y-m-d');
        $doc->sr = $request->sr;
        $doc->destinatario = $request->destinatario;
        $doc->cargoDest = $request->cargoDest?$request->cargoDest : null;
        $doc->referencia = $request->referencia;
        $doc->contenido = $request->contenido;
        if ($request->firma==1){
            $doc->remitente = $request->remitente;
            $doc->cargo = $request->cargoRemitente;
        }else if ($request->firma==2){
            $doc->remitente = 'UNIVERSAL BROKERS S.A';
        }else{
            $doc->remitente = 'NADIEs';
        }
        $user = Auth::user();
        $doc->descripcion = $user->idOficina.'\n'.$request->mosca;
        $doc->estado = 1;

        $doc_last = Make_document::latest()->first();
        if (!is_null($doc_last)) {
            if (intdiv(($doc_last->cite), 10000) != date('Y')) {
                $doc->cite = (int) (date('Y') . '0000');
            }
        } else {
            $doc->cite = (int) (date('Y') . '0000');
        }
        $doc->nombre = Type::find($request->idTipo)->nombre."-".$request->referencia;
        $doc->save();
        return $doc;
    }

    //CARTA
    public function exportPdfCarta(Request $request){
        $fecha = now();
        $req = $request;
        $pdf = Pdf::loadView('modelos.cartaPDF', compact('req','fecha'))->setPaper('letter','portrait');
        //return $pdf->download("carta.php");
        return $pdf->stream();
    }

    public function generarPdfInforme(Request $request){
        $pdf = PDF::loadView('modelos.informePDF', compact('request'))->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

}
