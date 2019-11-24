<!-- Modal Nuevo -->
  <div class="modal fade" id="ModalNuevo" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Nuevo Registro</h4>
        </div>
        <div class="modal-body">
          <form action="?action=insertar_usuarios" method="post" name="insercion">
            <div class="form-group">
              <label for="insercion_usuario">usuario:</label>
              <input type="text" class="form-control" id="insercion_usuario" name="insercion_usuario" maxlength="100" length="100" required>
            </div>

            <div class="form-group">
              <label for="insercion_clave">clave:</label>
              <input type="password" class="form-control" id="insercion_clave" name="insercion_clave" maxlength="20" length="20" required>
            </div>

            <div class="form-group">
              <label for="insercion_rol">Rol: </label>
              <select class="form-control" id="insercion_rol" name="insercion_rol">
                <?php 
                  foreach($modelRoles->Listar_Activos() as $r): 
                ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="insercion_empleado_id">Empleado Id:</label>
              <input type="password" class="form-control" id="insercion_empleado_id" name="insercion_empleado_id" maxlength="20" length="20" required>
            </div>

          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success botones" id="boton_add_modal" onclick="crear()">Insertar</button>
        </div>
      </div>
    </div>
  </div>

  <!--VERIFICAR CAMPOS A INSERTAR ANTES DE ENVIAR-->
<script type="text/javascript">
  crear = function(){
    if($("#insercion_usuario").val() === "" && $("#insercion_clave").val() === "" && $("#insercion_empleado_id").val() === ""){
        alertify.set('notifier','position', 'top-right');
        alertify.error('No Se Admiten Campos Vacios');
       }else{
        document.forms["insercion"].submit()
       }
  }
</script>