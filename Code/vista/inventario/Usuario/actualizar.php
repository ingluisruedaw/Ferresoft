<!-- Modal Actualizar -->
  <div class="modal fade" id="ModalUActializacion" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Actualizar</h4>
        </div>
        <div class="modal-body">
          <form action="?action=actualizar_usuarios" method="post" name="FormularioActualizarUs">
            <div class="form-group">
              <label for="ActualizarUsuarioU">Usuario:</label>
              <input type="text" class="form-control" id="ActualizarUsuarioU" name="ActualizarUsuarioU" readonly>
            </div>

            <div class="form-group">
              <label for="modal_rol">Rol: </label>
              <select class="form-control" id="modal_rol" name="modal_rol">
                <?php foreach($modelRoles->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="modal_empleado">Empleado: </label>
              <input type="text" class="form-control" id="modal_empleado" name="modal_empleado">
            </div>
          </form>

          <form action="?action=actualizar_clave_usuario" method="post" name="actualizarclavePass">
            <div class="form-group">
              <label for="modal_clave">Nueva Clave: </label>
              <input type="hidden" class="form-control" id="modal_usuario_n" name="modal_usuario_n">
              <input type="password" class="form-control" id="modal_clave" name="modal_clave">
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success" onclick="actualizar()">Actualizar Otros</button>
          <button type="submit" class="btn btn-primary" onclick="actualizarpass()">Actualizar Clave</button>
        </div>
      </div>
    </div>
  </div>

<!--LLENA LOS CAMPOS DEL MODAL ACTUALIZAR-->
<script>
  setEstados = function(usuario, rol, empleado){
    $('#ActualizarUsuarioU').val(usuario);
    alert();
    $('#modal_usuario_n').val(usuario);
    $('#modal_rol').val(rol);
    $('#modal_empleado').val(empleado);
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR-->
<script type="text/javascript">
  actualizar = function(){
    if($("#modal_empleado").val() === ""){
        alertify.set('notifier','position', 'top-right');
        alertify.error('NO SE ADMITEN CAMPOS VACIOS');
    }else{
        document.forms["FormularioActualizarUs"].submit()
    }
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR CLAVE-->
<script type="text/javascript">
  actualizarpass = function(){
    if($("#modal_clave").val() === ""){
        alertify.set('notifier','position', 'top-right');
        alertify.error('LA CLAVE NO PUEDE SER VACIO');
    }else{
        document.forms["actualizarclavePass"].submit()
    }
  }
</script>