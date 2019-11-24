<form action="?action=eliminar_productos" method="post" name="eliminacion">
  <input id="eliminar_id" name="eliminar_id" type="hidden" />
</form>

<!--CONFIRMAR ELIMINADO-->
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