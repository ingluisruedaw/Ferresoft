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
          <form action="?action=actualizar_nombre_proveedores" method="post" name="actualizacion">
            <div class="form-group">
              <label for="modal_id">Id:</label>
              <input type="text" class="form-control" id="modal_id" name="modal_id" readonly>
            </div>

            <div class="form-group">
              <label for="modal_det">Proveedor:</label>
              <input type="text" class="form-control" id="modal_det" name="modal_det">
            </div>
          </form>

          <form action="?action=actualizar_proveedores" method="post" name="actualizacion_otros">
            <div class="form-group">
              <input type="hidden" class="form-control" id="modal_idn" name="modal_idn" readonly>
            </div>

            <div class="form-group">
              <label for="modal_direccion">Dirección:</label>
              <input type="text" class="form-control" id="modal_direccion" name="modal_direccion">
            </div>

            <div class="form-group">
              <label for="modal_telefono">Telefono:</label>
              <input type="text" class="form-control" id="modal_telefono" name="modal_telefono">
            </div>

            <div class="form-group">
              <label for="modal_correo">Email:</label>
              <input type="text" class="form-control" id="modal_correo" name="modal_correo">
            </div>
          </form>
        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" onclick="actualizar()">Actualizar Nombre Proveedor</button>
          <button type="submit" class="btn btn-success" onclick="actualizarOtros()">Actualizar Otros</button>
        </div>
      </div>
    </div>
  </div>

<!--LLENA LOS CAMPOS DEL MODAL ACTUALIZAR-->
<script>
  setEstados = function(id, det, direccion, telefono, correo){
    $('#modal_id').val(id);
    $('#modal_idn').val(id);
    $('#modal_det').val(det);
    $('#modal_direccion').val(direccion);
    $('#modal_telefono').val(telefono);
    $('#modal_correo').val(correo);
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR PROVEDOR-->
<script type="text/javascript">
  actualizar = function(){
    if($("#modal_det").val() === ""){
      alertify.set('notifier','position', 'top-right');
      alertify.error('EL NOMBRE DEL PROVEEDOR NO PUEDE SER VACIO');
    }else{
      document.forms["actualizacion"].submit()
    }
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR OTROS-->
<script type="text/javascript">
  actualizarOtros = function(){
    if($("#modal_direccion").val() === "" || $("#modal_telefono").val() === "" ||$("#modal_correo").val() === ""){
      alertify.set('notifier','position', 'top-right');
      alertify.error('NO SE ADMITEN CAMPOS VACIOS');
    }else{
      document.forms["actualizacion_otros"].submit()
    }
  }
</script>