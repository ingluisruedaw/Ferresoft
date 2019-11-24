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
          <form action="?action=compras_insertar" method="post" name="insercion">
            <div class="form-group">
              <label for="insercion_id">Id:</label>
              <input type="text" class="form-control" id="insercion_id" name="insercion_id" value="se asigna automaticamente" readonly>
            </div>

            <div class="form-group">
              <label for="insertar_fecha">Fecha: </label>
              <input type="date" class="form-control" id="insertar_fecha" name="insertar_fecha">
            </div>

            <div class="form-group">
              <label for="insertar_producto">Producto: </label>
              <select class="form-control" id="insertar_producto" name="insertar_producto">
                <?php foreach($modelProductos->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('nombre');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="insertar_proveedor">Proveedor: </label>
              <select class="form-control" id="insertar_proveedor" name="insertar_proveedor">
                <?php foreach($modelProveedor->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="insertar_precio">Precio Con Iva: </label>
              <input type="number" class="form-control" id="insertar_precio" name="insertar_precio">
            </div>

            <div class="form-group">
              <label for="insertar_iva">Iva: </label>
              <select class="form-control" id="insertar_iva" name="insertar_iva">
                <?php foreach($modelIva->Listar_Activos() as $r): ?>
                    <option value="<?php echo $r->__GET('id');?>"><?php echo $r->__GET('det');?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="insertarcantidad">Cantidad: </label>
              <input type="number" class="form-control" id="insertarcantidad" name="insertarcantidad">
            </div>
          </form>
          <div class="form-group">
          <p style="color: red;" align="justify"><b> Debes Tener Mucho Cuidado Y Verificar Antes De Enviar El Formulario Ya Que Los Datos Que Introduzcas No Pueden Ser Eliminados Ni Alterados Desde Esta Plataforma.</b></p>
            </div>

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
    alertify.set('notifier','position', 'top-right');
    if (validarFecha($("#insertar_fecha").val())==true) {
      if ($("#insertar_precio").val() >= 0 ) {
        if ($("#insertarcantidad").val() > 0 ) {
          document.forms["insercion"].submit();
        }else{
          alertify.error('Cantidad No Valida');
        }
      }else{
        alertify.error('Precio No Valido');
      }
    }else{
      alertify.error('Debes Digitar Una Fecha');
    }
  }
</script>

<script type="text/javascript">
  var validarFecha = function(fecha){
 //Funcion validarFecha 
 //Escrita por Buzu feb 18 2010. (FELIZ CUMPLE BUZU!!!
 //valida fecha en formato aaaa-mm-dd
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