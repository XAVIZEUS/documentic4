<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Texto</title>
</head>
<body>
    <form id="textForm" action="{{ route('export.pdf') }}" method="POST">
        @csrf
        <textarea name="content" id="editor"></textarea>
        <button type="submit" target="_blank" class="btn btn-primary">Guardar Como PDF</button>
    </form>

    <form id="exportPdfForm" action="{{ route('export.pdf') }}" method="POST" >
        @csrf
        <input type="" name="content" id="exportPdfContent">
        <button type="submit">Exportar a PDF</button>
    </form>

    <form id="exportWordForm" action="{{ route('export.word') }}" method="POST">
        @csrf
        <textarea type="" name="content" id="exportWordContent"></textarea>
        <button type="submit">Exportar a Word</button>
    </form>
    
    
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor');

        document.querySelector('form#textForm').addEventListener("submit", function() {
            var content = CKEDITOR.instances.editor.getData();
            document.querySelector('input#exportPdfContent').value = content;
            document.querySelector('input#exportWordContent').value = content;
        });
    </script>
</body>
</html>
