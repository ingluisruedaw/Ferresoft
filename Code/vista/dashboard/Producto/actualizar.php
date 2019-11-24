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
          <form action="?action=actualizar_productos" method="post" name="actualizacion">
            <div class="form-group">
              <label for="modal_id">Id:</label>
              <input type="text" class="form-control" id="modal_id" name="modal_id" readonly>
            </div>

            <div class="form-group">
              <label for="modal_nombre">Nombre Producto: </label>
              <input type="text" class="form-control" id="modal_nombre" name="modal_nombre">
            </div>

            <div class="form-group">
              <label for="modal_embalaje">Embalaje Del Producto: </label>
              <select class="form-control" id="modal_embalaje" name="modal_embalaje">
                <?php foreach($modelEmbalaje->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="modal_categoria">Categoria Del Producto: </label>
              <select class="form-control" id="modal_categoria" name="modal_categoria">
                <?php foreach($modelCategoria->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
            </div>

          </form>

           <form action="?action=actualizar_stock_productos" method="post" name="actualizacion_stock">
            <div class="form-group">
              <label for="modal_stock">Stock: </label>
              <input type="hidden" class="form-control" id="modal_idn" name="modal_idn">
              <input type="text" class="form-control" id="modal_stock" name="modal_stock">
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success" onclick="actualizar()">Actualizar Otros</button>
          <button type="submit" class="btn btn-primary" onclick="actualizarStock()">Actualizar Stock</button>
        </div>
      </div>
    </div>
  </div>

  



<!--LLENA LOS CAMPOS DEL MODAL ACTUALIZAR-->
<script>
  setEstados = function(id, nombre, stock, embalaje, categoria){
    $('#modal_id').val(id);
    $('#modal_idn').val(id);
    $('#modal_nombre').val(nombre);
    $('#modal_stock').val(stock);
    $('#modal_embalaje').val(embalaje);
    $('#modal_categoria').val(categoria);
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR-->
<script type="text/javascript">
  actualizar = function(){
    document.forms["actualizacion"].submit()
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR STOCK-->
<script type="text/javascript">
  actualizarStock = function(){
    document.forms["actualizacion_stock"].submit()
  }
</script>