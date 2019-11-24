<!-- Modal Nuevo -->
  <div class="modal fade" id="modalCobrar" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Nuevo Registro</h4>
        </div>
        <div class="modal-body">
          <form action="?action=msAONLRfp20m7x5Tx8JQ" method="post" name="cobrar">
            <div class="form-group">
              <label for="cobrar_factura_id">Factura Id: : </label>
              <input type="number" class="form-control" id="cobrar_factura_id" name="cobrar_factura_id" value="<?php echo $_SESSION['factura']; ?>" readonly />
            </div>

            <div class="form-group">
              <label for="insercion_factura_cobrar">Total a cobrar:</label>
              <input type="hidden" class="form-control" id="cobrar_total" name="cobrar_total" value="<?php echo $modelFactura->BuscarTotalTemporal($_SESSION['factura']); ?>" readonly />
              <input type="text" class="form-control" id="insercion_factura_cobrar" name="insercion_factura_cobrar" value="<?php echo '$ '.number_format($modelFactura->BuscarTotalTemporal($_SESSION['factura'])); ?>" readonly />
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success botones" id="boton_add_modal" onclick="cobrare()">Cobrar</button>
        </div>
      </div>
    </div>
  </div>

  <!--VERIFICAR CAMPOS A INSERTAR ANTES DE ENVIAR-->
<script type="text/javascript">
  cobrare = function(){
    if($("#insercion_factura_cobrar").val() === ""){
        alertify.set('notifier','position', 'top-right');
        alertify.error('No Se Admiten Campos Vacios');
       }else{
        document.forms["cobrar"].submit()
       }
  }
</script>