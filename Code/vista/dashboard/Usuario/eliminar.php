<form action="?action=eliminar_usuarios" method="post" name="eliminacion">
  <input id="eliminar_usuario" name="eliminar_usuario" type="hidden" />
</form>

<!--CONFIRMAR ELIMINADO-->
<script type="text/javascript">
  eliminar = function(id){
  	alertify.dialog('confirm').set({transition:'slide'}); 
    alertify.confirm('CONFIRMAR LA ACCIÓN', '¿Estás Seguro?', 
      function(){
        $('#eliminar_usuario').val(id);
        document.forms["eliminacion"].submit()
      }, 
      function(){ 
        alertify.error('ACCIÓN CANCELADA')
      });
  }
</script>