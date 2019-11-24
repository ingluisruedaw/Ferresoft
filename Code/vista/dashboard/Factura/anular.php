<form action="?action=anular_facturas_activas" method="post" name="anulacion">
  <input id="anular_factura_id" name="anular_factura_id" type="hidden" />
</form>

<!--CONFIRMAR ELIMINADO-->
<script type="text/javascript">
  anular = function(id){
  	alertify.dialog('confirm').set({transition:'slide'}); 
    alertify.confirm('CONFIRMAR LA ACCIÓN', 'Esta Acción Es Irreversible Desde Esta Aplicación, ¿Estás Seguro?', 
      function(){
        $('#anular_factura_id').val(id);
        document.forms["anulacion"].submit()
      }, 
      function(){ 
        alertify.error('ACCIÓN CANCELADA')
      });
  }
</script>