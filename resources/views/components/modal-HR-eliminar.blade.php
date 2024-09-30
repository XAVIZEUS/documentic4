  <!--Eliminar HOJA De RUTA-->
  <div class="modal fade" id="eliminarHR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content text-center">
              <div class="modal-body">
                  ¿Está seguro de eliminar este registro?
              </div>
              <div class="modal-footer">                    
                  <form id="eliminar-form" method="POST" action="{{ route('eliminar.hr') }}">
                      @csrf
                      <!-- Otros campos del formulario aquí -->
                      <input type="hidden" id = "idhr" name="idhr" >
                      
                      <button type="submit" class="btn btn-danger">Eliminar</button>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  </form> 
              </div>
          </div>
      </div>
  </div>