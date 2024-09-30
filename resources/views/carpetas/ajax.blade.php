<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Item</title>
    <!-- Incluye la biblioteca jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <h1>Registrar Item</h1>

    <!-- Formulario para registrar un nuevo item -->
    <form id="itemForm">
        @csrf <!-- Token de seguridad para prevenir ataques CSRF -->
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required> <!-- Campo para el nombre del item -->
        </div>
        <div>
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required></textarea> <!-- Campo para la descripción del item -->
        </div>
        <button type="submit">Registrar</button> <!-- Botón para enviar el formulario -->
    </form>

    <!-- Div para mostrar la respuesta del servidor -->
    <div id="response"></div>

    <script>
        $(document).ready(function() {
            // Obtén la URL de la ruta nombrada 'items.store' definida en routes/web.php
            var formUrl = "{{ route('items.store') }}";

            // Maneja el evento 'submit' del formulario con id 'itemForm'
            $('#itemForm').on('submit', function(event) {
                // Previene el comportamiento predeterminado del formulario (que sería recargar la página)
                event.preventDefault();

                // Realiza la solicitud AJAX
                $.ajax({
                    url: formUrl, // URL de la ruta nombrada para la solicitud
                    type: 'POST', // Método HTTP que se usará (POST)
                    data: $(this).serialize(), // Serializa los datos del formulario para enviarlos
                    success: function(response) {
                        // Maneja la respuesta exitosa del servidor
                        $('#response').html(`
                            <h2>Item registrado</h2>
                            <p><strong>Nombre:</strong> ${response.name}</p>
                            <p><strong>Descripción:</strong> ${response.description}</p>
                        `);
                        // Resetea el formulario después de una solicitud exitosa
                        $('#itemForm')[0].reset();
                    },
                    error: function(xhr) {
                        // Maneja cualquier error que pueda ocurrir durante la solicitud
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
