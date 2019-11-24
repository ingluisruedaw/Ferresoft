<!-- Modal Nuevo -->
  <div class="modal fade" id="modalPrepararFactura" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Datos Básicos</h4>
        </div>
        <div class="modal-body"> 
          <form name="insercion" method="POST" action="?action=datos_basicos_preparar_factura">
            
            <div class="form-group">
              <label for="insercion_id">Id:</label>
              <input type="text" class="form-control" id="insercion_id" name="insercion_id" value="se asigna automaticamente" readonly>
            </div>

            <div class="form-group">
              <label for="insercion_fecha">Fecha: </label>
              <input type="date" class="form-control" id="insercion_fecha" name="insercion_fecha"/>
            </div>

            <div class="form-group">
              <label for="insercion_empleado_id">Empleado: </label>
              <input type="text" class="form-control" id="insercion_empleado_id" name="insercion_empleado_id" value="<?php echo $_SESSION['empleado_id'];?>" readonly="" />
            </div>

            <div class="form-group">
              <label for="insercion_cliente_id">Cliente</label>
              <select class="form-control" id="insercion_cliente_id" name="insercion_cliente_id">
                <?php foreach($modelCliente->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('persona_nombres');?></option>
                <?php endforeach; ?>
              </select>
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
    if (validarFecha($("#insercion_fecha").val())==true && $("#insercion_empleado_id").val() >= 0 && $("#insercion_cliente_id").val() > 0) {
      document.forms["insercion"].submit();
    }else{
      alertify.error('NO SE ADMITEN VACIOS');
    }
  }
</script>

<script type="text/javascript">
  var validarFecha = function(fecha){
 var fechaArr = fecha.split('-');
 var aho = fechaArr[0];
 var mes = fechaArr[1];
 var dia = fechaArr[2];
 
 var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0

 if(!plantilla || plantilla.getFullYear() == aho && plantilla.getMonth() == mes -1 && plantilla.getDate() == dia){
 return true;
 }else{
 return false;
 }
}
</script>