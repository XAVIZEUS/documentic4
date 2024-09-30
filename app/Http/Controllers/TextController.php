<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class TextController extends Controller
{

    public function index()
    {
        return view('usuario.editor2');
    }



    public function exportPdf(Request $request)
    {
        $content = $request->input('content');

        $dompdf = new Dompdf();
        $dompdf->loadHtml($content);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('document.pdf', ['Attachment' => 0]);
    }

    public function exportWord(Request $request)
    {
        $content = $request->input('content');

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText(htmlspecialchars_decode($content));

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'document.docx';

        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $objWriter->save("php://output");
        exit;
    }


    public function users(){
        $usuario = User::get();
        return response()->json($usuario);
    }
}
