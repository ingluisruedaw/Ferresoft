<!-- Modal Nuevo -->
  <div class="modal fade" id="ModalAgregar" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Agregar</h4>
        </div>
        <div class="modal-body"> 
          <form name="agregacion" method="POST" action="?action=78SqNdwrnRLDt0TMeA5E">
             <div class="form-group">
              <label for="insercion_factura_id">Factura Id: : </label>
              <input type="number" class="form-control" id="insercion_factura_id" name="insercion_factura_id" value="<?php echo $_SESSION['factura']; ?>" readonly />
            </div>

          <div class="form-group">
              <label for="insercion_producto_id">Producto</label>
              <select class="form-control" id="insercion_producto_id" name="insercion_producto_id">
                <?php foreach($modelFactura->Listar_ProductosFacturaTemporal() as $r): ?>
                    <option value="<?php echo $r->__GET('precio_venta_id');?>"><?php echo $r->__GET('embalaje_det').' '.$r->__GET('productos_nombre');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="insercion_cantidad">Cantidad: </label>
              <input type="number" class="form-control" id="insercion_cantidad" name="insercion_cantidad" value="1" />
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success botones" id="botonActualizar" onclick="crear()">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <!--VERIFICAR CAMPOS A INSERTAR ANTES DE ENVIAR-->
<script type="text/javascript">
  crear = function(){

    alertify.set('notifier','position', 'top-right');
    if ($("#insercion_factura_id").val() === "" || $("#insercion_producto_id").val() === "" || $("#insercion_cantidad").val() < 0) {
      alertify.error('NO SE ADMITEN VACIOS');
    }else{
      document.forms["agregacion"].submit();
    }
  }
</script>