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
          <form action="?action=insertar_productos" method="post" name="insercion">
            <div class="form-group">
              <label for="insertar_id">Id:</label>
              <input type="text" class="form-control" id="insertar_id" name="insertar_id" value="se asigna automaticamente" readonly>
            </div>

            <div class="form-group">
              <label for="insertar_nombre">Nombre Producto: </label>
              <input type="text" class="form-control" id="insertar_nombre" name="insertar_nombre">
            </div>

            <div class="form-group">
              <label for="insertar_stock">Stock: </label>
              <input type="text" class="form-control" id="insertar_stock" name="insertar_stock">
            </div>

            <div class="form-group">
              <label for="insertar_embalaje">Embalaje Del Producto: </label>
              <select class="form-control" id="insertar_embalaje" name="insertar_embalaje">
                <?php foreach($modelEmbalaje->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="insertar_categoria">Categoria Del Producto: </label>
              <select class="form-control" id="insertar_categoria" name="insertar_categoria">
                <?php foreach($modelCategoria->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
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
    if($("#insertar_nombre").val() === "" || $("#insertar_stock").val() === ""){
        alertify.set('notifier','position', 'top-right');
        alertify.error('No Se Admiten Campos Vacios');
       }else{
        document.forms["insercion"].submit()
       }
  }
</script>