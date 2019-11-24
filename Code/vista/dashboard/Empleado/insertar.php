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
          <form action="?action=insertar_empleados" method="post" name="insercion">

            <div class="form-group">
              <label for="insercion_id">Id Cliente:</label>
              <input type="text" class="form-control" id="insercion_id" name="insercion_id" value="se asigna automaticamente" readonly>
            </div>

            <div class="form-group">
              <label for="insercion_fingreso">Fecha De Ingreso:</label>
              <input type="date" class="form-control" id="insercion_fingreso" name="insercion_fingreso" maxlength="100" length="100" required/>
            </div>

            <div class="form-group">
              <label for="insercion_documento">Número De Documento:</label>
              <input type="text" class="form-control" id="insercion_documento" name="insercion_documento" maxlength="100" length="100" required/>
            </div>

            <div class="form-group">
              <label for="insercion_nombres">Nombres:</label>
              <input type="text" class="form-control" id="insercion_nombres" name="insercion_nombres" maxlength="100" length="100" required/>
            </div>

            <div class="form-group">
              <label for="insercion_direccion">Dirección:</label>
              <input type="text" class="form-control" id="insercion_direccion" name="insercion_direccion" maxlength="100" length="100" required/>
            </div>

            <div class="form-group">
              <label for="insercion_telefono">Telefono:</label>
              <input type="number" class="form-control" id="insercion_telefono" name="insercion_telefono" maxlength="100" length="100" required/>
            </div>

            <div class="form-group">
              <label for="insercion_email">Email:</label>
              <input type="email" class="form-control" id="insercion_email" name="insercion_email" maxlength="100" length="100" required/>
            </div>

            <div class="form-group">
              <label for="insercion_cargo">Cargo:</label>
              <input type="text" class="form-control" id="insercion_cargo" name="insercion_cargo" maxlength="100" length="100" required/>
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
    alertify.set('notifier','position', 'top-right');
    if (validarFecha($("#insercion_fingreso").val())==false || $("#insercion_documento").val() === "" || $("#insercion_nombres").val() === "" || $("#insercion_direccion").val() === "" || $("#insercion_telefono").val() === "" || $("#insercion_email").val() === "" || $("#insercion_cargo").val() === "") {
        alertify.error('NO SE ADMITEN CAMPOS VACIOS');
    }else{
      document.forms["insercion"].submit();
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