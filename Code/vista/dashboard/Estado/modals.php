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
          <form action="?action=actualizar_estados" method="post" name="actualizacion">
            <div class="form-group">
              <label for="modal_id">Id:</label>
              <input type="text" class="form-control" id="modal_id" name="modal_id" readonly>
            </div>

            <div class="form-group">
              <label for="modal_det">Det:</label>
              <input type="text" class="form-control" id="modal_det" name="modal_det">
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" onclick="actualizar()">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

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
          <form action="?action=insertar_estados" method="post" name="insercion">
            <div class="form-group">
              <label for="insercion_id">Id:</label>
              <input type="text" class="form-control" id="insercion_id" name="insercion_id" value="se asigna automaticamente" readonly>
            </div>

            <div class="form-group">
              <label for="insercion_det">Det:</label>
              <input type="text" class="form-control" id="insercion_det" name="insercion_det" maxlength="100" length="100" required/>
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

<form action="?action=eliminar_estados" method="post" name="eliminacion">
  <input id="eliminar_id" name="eliminar_id" type="hidden" />
</form>

<script>
  setEstados = function(id, det){
    $('#modal_id').val(id);
    $('#modal_det').val(det);
  }
</script>

<script type="text/javascript">
  actualizar = function(){
    document.forms["actualizacion"].submit()
  }
</script>

<script type="text/javascript">
  crear = function(){
    if($("#insercion_det").val() === ""){
        alertify.set('notifier','position', 'top-right');
        alertify.error('No Se Admiten Campos Vacios');
       }else{
        document.forms["insercion"].submit()
       }
  }
</script>

<script type="text/javascript">
  eliminar = function(id){
  	alertify.dialog('confirm').set({transition:'slide'}); 
    alertify.confirm('CONFIRMAR LA ACCIÓN', '¿Estás Seguro?', 
      function(){
        $('#eliminar_id').val(id);
        document.forms["eliminacion"].submit()
      }, 
      function(){ 
        alertify.error('ACCIÓN CANCELADA')
      });
  }
</script>