<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Ventas Activas</h1>
                </div>
                <div>
                    <button type="submit" id="botonAgregar" data-toggle="modal" data-target="#ModalFiltrado"> Filtrar Por Fechas
                    </button>
                        <br><br>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>                
                  <th>Id</th>
                  <th>Empleado Nombres</th>
                  <th>Cliente Nombres</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Empleado Nombres</th>
                  <th>Cliente Nombres</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
              <?php 
                $atotal=0; 
              ?>
                <?php foreach($modelFactura->Listar_Activos() as $r): 
                  $aid=$r->__GET('id');
                ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('empleados_nombres'); ?></td>
                    <td><?php echo $r->__GET('clientes_nombres'); ?></td>
                    <td><?php echo $r->__GET('fecha'); ?></td>
                    <td><?php echo '$ '.number_format($r->__GET('total')); ?></td>
                    <?php $atotal=$atotal+$r->__GET('total'); ?>
                    <td><button type="submit" class="botones" id="botonEliminar" data-toggle="modal" data-target="#ModalListar"onclick="detalles('<?php echo $r->__GET('id');?>')">Ver Detalle</button></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tr>
                  <td colspan="4">Total Venta: </td>
                  <td><?php echo '$ '.number_format($atotal); ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <form id="ver_factura" name="ver_factura" action="?action=listado_detalle_facturas" method="POST">
      <input type="hidden" name="ver_factura_id" id="ver_factura_id">
    </form>
    <?php  require('filtrado.php');?>

    <script type="text/javascript">
      detalles = function (id){
        $('#ver_factura_id').val(id);
        /*alert(id);*/
        document.forms["ver_factura"].submit();
      }
    </script>
