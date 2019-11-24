<!-- Modal Actualizar -->
  <div class="modal fade" id="ModalActualizarClave" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Actualizar</h4>
        </div>
        <div class="modal-body">
          <form action="?action=9fG6XRoOMAluWAPHffJ2" method="post" name="actualizarcion_clave">
            <div class="form-group">
              <label for="modal_usuario">Usuario:</label>
              <input type="text" class="form-control" id="modal_usuario" name="modal_usuario" value="<?php echo $_SESSION['username'];?>" readonly>
            </div>

            <div class="form-group">
              <label for="modal_clave">Nueva Clave:</label>
              <input type="password" class="form-control" id="modal_clave" name="modal_clave" >
            </div>

            <div class="form-group">
              <label for="modal_rclave">Confirmar Nueva Clave</label>
              <input type="password" class="form-control" id="modal_rclave" name="modal_rclave" >
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" onclick="actualizar()">Actualizar Clave</button>
        </div>
      </div>
    </div>
  </div>

<!--ENVIA EL FORMULARIO ACTUALIZAR CLAVE-->
<script type="text/javascript">
  actualizar = function(){
    if($("#modal_usuario").val() === "" || $("#modal_clave").val() === "" || $("#modal_rclave").val() === ""){
        alertify.set('notifier','position', 'top-right');
        alertify.error('No Se Admiten Campos Vacios');
       }else{
        if ($("#modal_clave").val() === $("#modal_rclave").val()) {
          document.forms["actualizarcion_clave"].submit();
        }else{
          alertify.set('notifier','position', 'top-right');
          alertify.error('Las Claves No Coinciden');
        }        
       }
  }
</script>