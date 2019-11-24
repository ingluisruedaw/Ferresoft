<!-- Modal Nuevo -->
  <div class="modal fade" id="ModalFiltrado" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0d00ff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">Formulario Filtrado Por Fechas</h4>
        </div>
        <div class="modal-body">
          <form action="?action=listado_ventas_activas_por_fechas" method="post" name="filtracion">
            <div class="form-group">
              <label for="filtrado_finicial">Fecha Inicial: </label>
              <input type="date" class="form-control" id="filtrado_finicial" name="filtrado_finicial">
            </div>

            <div class="form-group">
              <label for="filtrado_ffin">Fecha Final: </label>
              <input type="date" class="form-control" id="filtrado_ffin" name="filtrado_ffin"/>
            </div>
          </form>

        </div>
        <div class="modal-footer" style="background-color: #333;">
          <button type="button" class="btn btn-danger botones" id="botonEliminar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success botones" id="boton_add_modal" onclick="filtrar()">Filtrar</button>
        </div>
      </div>
    </div>
  </div>

  <!--VERIFICAR CAMPOS A INSERTAR ANTES DE ENVIAR-->
<script type="text/javascript">
  filtrar = function(){
    if($("#filtrado_finicial").val() === "" || $("#filtrado_ffin").val() === "" ){
        alertify.set('notifier','position', 'top-right');
        alertify.error('No Se Admiten Campos Vacios');
       }else{
        document.forms["filtracion"].submit()
       }
  }
</script>