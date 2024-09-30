<!DOCTYPE html>
<html lang="es">
<head>
    <x-head/>
    <title>Integrar CKEditor con Exportación a PDF</title>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
</head>
<body>
    <h1>Editor de texto CKEditor con Exportación a PDF</h1>
    <textarea id="editor">Escribe tu texto aquí...</textarea>
    <button onclick="exportarPDF()">Exportar a PDF</button>

    <script>
        // Inicializar CKEditor
        CKEDITOR.replace('editor');

        // Función para exportar contenido a PDF
        function exportarPDF() {
            // Obtener el contenido HTML generado por CKEditor
            var contentHtml = CKEDITOR.instances.editor.getData();

            // Crear un nuevo documento PDF
            var doc = new jsPDF();

            // Agregar el contenido HTML al PDF
            doc.html(contentHtml, {
                callback: function (doc) {
                    // Guardar el PDF con un nombre específico
                    doc.save('documento.pdf');
                }
            });
        }
    </script>
</body>
</html>
