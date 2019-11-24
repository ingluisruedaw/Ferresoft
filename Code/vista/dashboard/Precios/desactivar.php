<form action="?action=desactivar_precios_de_venta_de_productos" method="post" name="desactivacion">
  <input id="desactivar_id" name="desactivar_id" type="hidden" />
</form>

<!--CONFIRMAR ELIMINADO-->
<script type="text/javascript">
  desactivar = function(id){
    alertify.dialog('confirm').set({transition:'slide'}); 
    alertify.confirm('CONFIRMAR LA ACCIÓN', 'Ejecutar Esta Acción Puede Ser Perjudicial Para El Sistema, Utilízala Solo Si Estas Completamente Seguro De Lo Que Vas A Realizar¿Estás Seguro?', 
      function(){
        $('#desactivar_id').val(id);
        document.forms["desactivacion"].submit()
      }, 
      function(){ 
        alertify.error('ACCIÓN CANCELADA')
      });
  }
</script>