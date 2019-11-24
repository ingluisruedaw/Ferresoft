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
          <form action="?action=actualizar_categorias" method="post" name="actualizacion">
            <div class="form-group">
              <label for="modal_id">Id:</label>
              <input type="text" class="form-control" id="modal_id" name="modal_id" readonly>
            </div>

            <div class="form-group">
              <label for="modal_det">Categoria: </label>
              <input type="text" class="form-control" id="modal_det" name="modal_det">
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" onclick="actualizar()">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  



<!--LLENA LOS CAMPOS DEL MODAL ACTUALIZAR-->
<script>
  setEstados = function(id, det){
    $('#modal_id').val(id);
    $('#modal_det').val(det);
  }
</script>

<!--ENVIA EL FORMULARIO ACTUALIZAR-->
<script type="text/javascript">
  actualizar = function(){
    document.forms["actualizacion"].submit()
  }
</script>