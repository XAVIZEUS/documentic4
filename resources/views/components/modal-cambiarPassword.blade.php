
<div class="modal fade" id="cambiarPassword" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Boton para cerrar modal
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>-->
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('usuario.cambiar') }}" method="post" id="passwordForm">
                    @csrf
                    <h3 class="text-center">CAMBIAR CONTRASEÑA</h3>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label" for="contrasena">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ejemplo: ADM" required>
                            <button class="btn btn-outline-secondary border-start-0 rounded-end" type="button" id="eye" aria-label="Mostrar/Ocultar Contraseña">
                                <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirmarcontrasena">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmarcontrasena" name="confirmarcontrasena" placeholder="Ejemplo: Administración" required>
                            <button class="btn btn-outline-secondary border-start-0 rounded-end" type="button" id="eye2" aria-label="Mostrar/Ocultar Contraseña">
                                <i class="bi bi-eye-slash" id="toggleConfirmPasswordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div id="error-message" class="text-danger" style="display: none;">
                        Las contraseñas no coinciden.
                    </div>
                    <button id="guardarCambios" type="button" class="btn btn-success btn-user btn-block mt-5">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar y mostrar contraseña
        let eye = document.getElementById('eye');
        let input = document.getElementById('contrasena');
        eye.addEventListener("click", function() {
            if (input.type === "password") {
                input.type = "text";
                eye.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                input.type = "password";
                eye.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        });

        // Ocultar y mostrar confirmar contraseña
        let eye2 = document.getElementById('eye2');
        let input2 = document.getElementById('confirmarcontrasena');
        eye2.addEventListener("click", function() {
            if (input2.type === "password") {
                input2.type = "text";
                eye2.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                input2.type = "password";
                eye2.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        });

        // Verificar si las contraseñas coinciden antes de enviar el formulario
        let guardarCambios = document.getElementById('guardarCambios');
        guardarCambios.addEventListener('click', function() {
            let password = document.getElementById('contrasena').value;
            let confirmPassword = document.getElementById('confirmarcontrasena').value;
            let errorMessage = document.getElementById('error-message');

            if (password !== confirmPassword) {
                errorMessage.style.display = 'block';  // Mostrar mensaje de error
            } else {
                errorMessage.style.display = 'none';  // Ocultar mensaje de error
                document.getElementById('passwordForm').submit();  // Enviar el formulario
            }
        });
    });
</script>
