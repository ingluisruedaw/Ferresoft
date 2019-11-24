<!-- Modal Actualizar -->
  <div class="modal fade" id="ModalActualizar" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Actualizar</h4>
        </div>
        <div class="modal-body">
          <form action="?action=actualizar_clientes" method="post" name="actualizacion">
            <div class="form-group">
              <label for="modal_codigo">Id Cliente:</label>
              <input type="text" class="form-control" id="modal_codigo" name="modal_codigo" readonly>
            </div>

            <div class="form-group">
              <label for="modal_id">Número Documento:</label>
              <input type="text" class="form-control" id="modal_id" name="modal_id" readonly>
            </div>

            <div class="form-group">
              <label for="modal_nombres">Nombres:</label>
              <input type="text" class="form-control" id="modal_nombres" name="modal_nombres">
            </div>

            <div class="form-group">
              <label for="modal_direccion">Direccion:</label>
              <input type="text" class="form-control" id="modal_direccion" name="modal_direccion">
            </div>

            <div class="form-group">
              <label for="modal_telefono">Telefono:</label>
              <input type="text" class="form-control" id="modal_telefono" name="modal_telefono">
            </div>

            <div class="form-group">
              <label for="modal_correo">Correo:</label>
              <input type="text" class="form-control" id="modal_correo" name="modal_correo">
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" onclick="actualizar()">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  



<!--LLENA LOS CAMPOS DEL MODAL ACTUALIZAR-->
<script>
  setEstados = function(codigo, id, nombres, direccion, telefono, correo){
    $('#modal_codigo').val(codigo);
    $('#modal_id').val(id);
    $('#modal_nombres').val(nombres);
    $('#modal_direccion').val(direccion);
    $('#modal_telefono').val(telefono);
    $('#modal_correo').val(correo);
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR-->
<script type="text/javascript">
  actualizar = function(){
    document.forms["actualizacion"].submit()
  }
</script>