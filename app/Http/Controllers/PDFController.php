<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Http\Request;
use TCPDF;

class PDFController extends Controller
{
    public function generatePDF($idUsuario)
    {
        $datosUsuario = User::find($idUsuario);
        $seguimientos = Tracking::where('derivado_por', $idUsuario)
                        //->where('estado',3)
                        //->orWhere('estado',3)
                        ->get();
        //return $seguimientos;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        //-------------------------- CONFIGURACIONES DEL DOCUMENTO --------------------------------
        // Configuración del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Reporte de Seguimientos');
        $pdf->SetSubject('Reporte');
        $pdf->SetKeywords('TCPDF, PDF, Laravel, Reporte');

        // Configuración de encabezado y pie de página
        $pdf->setHeaderData('', 0, 'Reporte de Seguimientos', '');
        $pdf->setFooterData('', [0, 64, 0], [0, 64, 128]);

        // Configuración de fuente
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Margenes
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Salto de página automático
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Establecer fuente
        $pdf->SetFont('helvetica', '', 10);

        //-------------------------- CONFIGURACIONES DEL DOCUMENTO --------------------------------



        //-------------------------- CUERPO DEL DOCUMENTO --------------------------------
        // Añadir una página
        $pdf->AddPage();

        // Contenido HTML
        $html = '
        <style>
        
        h1 {
            
            text-transform:uppercase;
        }
        </style>
        <div style="text-align: center;">
            <h1 style="font-size:30px;">REPORTE BANDEJA DE Salida</h1>
         </div>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Datos del Usuario
        $html = '<h2 style="font-size:18px; color:#34495e; text-transform:uppercase; border-bottom: 4px solid #154733; " >Datos del Usuario</h2>
         <table border="0" cellspacing="0" cellpadding="10">
            <tr>
                <td width="65"><strong>Usuario: </strong></td>
                <td>'.$datosUsuario->usuario.'</td>
            </tr>
            <tr>
                <td width="65"><strong>Nombre:</strong></td>
                <td>'.$datosUsuario->nombres.' '.$datosUsuario->apellidos.'</td>
            </tr>
         </table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Tabla de Seguimiento
        $html = '
        <h2 style="font-size:18px; color:#34495e; text-transform:uppercase;">Seguimiento</h2>';
            foreach ($seguimientos as $seg) {
            $html .= '
        <table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th colspan="8" style="text-align: center; background-color: #154733; color: #fff;"><strong> HOJA DE RUTA: '.$seg->idHruta.'</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>DERIVADO POR:</strong></td>
                    <td>' . $seg->derivador->usuario . '</td>
                    <td><strong>FECHA:</strong></td>
                    <td>' . $seg->f_derivacion . '</td>
                    <td><strong>REFERENCIA:</strong></td>
                    <td>' . $seg->roadmaps->referencia . '</td>
                    <td><strong>ACCION:</strong></td>
                    <td>' . $seg->actions->nombre . '</td>
                </tr>
                <tr>
                    <td><strong>DERIVADO A:</strong></td>
                    <td>' . (($seg->derivadoA) ? $seg->derivadoA->usuario : 'a todos') . '</td>
                    <td><strong>REMITENTE:</strong></td>
                    <td>' . $seg->roadmaps->instituto_remitente . '</td>
                    <td><strong>PROVEIDO:</strong></td>
                    <td>' . $seg->proveido . '</td>
                    <td><strong>OBSERVACION:</strong></td>
                    <td>' . $seg->observacion . '</td>
                </tr>
                <tr>
                    <td colspan="8" style="background-color: #f0f0f0;">&nbsp;</td>
                </tr> 
            </tbody>
        </table>';
        }

        // Salida del contenido HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del PDF
        $pdf->Output('reporte_seguimientos.pdf', 'I');
    }

    public function imprimirHojaRuta($idHojaRuta){
        $HojaRuta = Roadmap::with('trackings')->find($idHojaRuta);

        $seguimientos = Tracking::where('idHruta',$idHojaRuta)
                    ->with('derivador', 'actions', 'derivadoA', 'documents')->get();




        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        //-------------------------- CONFIGURACIONES DEL DOCUMENTO --------------------------------
        // Configuración del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Reporte de Seguimientos');
        $pdf->SetSubject('Reporte');
        $pdf->SetKeywords('TCPDF, PDF, Laravel, Reporte');

        // Configuración de encabezado y pie de página
        $pdf->setHeaderData('', 0, 'Reporte de Seguimientos', '');
        $pdf->setFooterData('', [0, 64, 0], [0, 64, 128]);

        // Configuración de fuente
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Margenes
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Salto de página automático
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Establecer fuente
        $pdf->SetFont('helvetica', '', 10);

        //-------------------------- CONFIGURACIONES DEL DOCUMENTO --------------------------------



        //-------------------------- CUERPO DEL DOCUMENTO --------------------------------
        // Añadir una página
        $pdf->AddPage();

        // Contenido HTML
        $html = '
    <h1 style="text-align: center; font-weight: bold; color: #154733;">HOJA DE RUTA: ' . $HojaRuta->idHruta . '</h1>
    
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th colspan="6" style="background-color: #6c757d; color: #ffffff; text-align: center;">DATOS DE LA HOJA DE RUTA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="text-align: left;">Codigo:</th>
                <td>' . $HojaRuta->codigo . '</td>
                <th style="text-align: left;">Originado por:</th>
                <td>' . $HojaRuta->user->usuario . '</td>
                <th style="text-align: left;">Fecha de Creacion:</th>
                <td>' . $HojaRuta->f_creacion . '</td>
            </tr>
            <tr>
                <th colspan="6" style="background-color: #6c757d; color: #ffffff; text-align: center;">DATOS DEL REMITENTE</th>
            </tr>
            <tr>
                <th style="text-align: left;">Nombre remitente:</th>
                <td>' . $HojaRuta->remitente . '</td>
                <th style="text-align: left;">Cargo:</th>
                <td>' . $HojaRuta->cargo_remitente . '</td>
                <th style="text-align: left;">Institucion:</th>
                <td>' . $HojaRuta->instituto_remitente . '</td>
            </tr>
        </tbody>
    </table>
    
    <br><h3 style="text-align: center; font-weight: bold; color: #154733;">LISTA DE SEGUIMIENTOS</h3><br>

    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #154733; color: #ffffff;">
                <th colspan="3" style="text-align: center;">DERIVADO</th>
                <th style="text-align: center;">PROVEIDO</th>
                <th style="text-align: center;">OBSERVACION</th>
                <th style="text-align: center;">ACCION</th>
            </tr>
        </thead>
        <tbody>';

    // Iterar sobre los seguimientos
    foreach ($seguimientos as $seg) {
        $html .= '
            <tr>
                <td style="text-align: right;">De: ' . $seg->derivador->usuario . '</td>
                <td rowspan="2" style="text-align: center;">=></td>
                <td style="text-align: left;">' . ($seg->derivadoA ? $seg->derivadoA->usuario : 'Oficina: ' . $seg->observacion) . '</td>
                <td rowspan="2">' . $seg->proveido . '</td>
                <td rowspan="2">' . $seg->observacion . '</td>
                <td>' . $seg->actions->nombre . '</td>
            </tr>
            <tr>
                <td>' . $seg->f_derivacion . '</td>
                <td>' . ($seg->f_recepcion ? $seg->f_recepcion : 'No recibido') . '</td>
                <td>
                    que ponemos aca
                </td>
            </tr>
            <tr>
                <td colspan="6" style="background-color: #28a745; line-height: -5px; padding: 0; margin: 0;"></td>
            </tr>
            ';
    }

    $html .= '
        </tbody>
    </table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del PDF
        $pdf->Output('reporte_seguimientos.pdf', 'I');

    }
}
