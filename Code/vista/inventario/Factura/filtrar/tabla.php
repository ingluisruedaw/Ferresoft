<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Resultado De La Busqueda</h1>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>                
                  <th>Id</th>
                  <th>Empleadp Id</th>
                  <th>Empleadp Nombres</th>
                  <th>Cliente Id</th>
                  <th>Cliente Nombres</th>
                  <th>Fecha</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Empleadp Id</th>
                  <th>Empleadp Nombres</th>
                  <th>Cliente Id</th>
                  <th>Cliente Nombres</th>
                  <th>Fecha</th>
                  <th>Total</th>
                </tr>
              </tfoot>
              <tbody>
              <?php 
                $atotal=0; 
                $afinicial = $_REQUEST['filtrado_finicial'].'%';
                $affin = $_REQUEST['filtrado_ffin'].'%';
              ?>
                <?php foreach($modelFactura->Listar_Activos_Por_Fechas($afinicial,$affin) as $r): ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('empleados_id'); ?></td>
                    <td><?php echo $r->__GET('empleados_nombres'); ?></td>
                    <td><?php echo $r->__GET('clientes_id'); ?></td>
                    <td><?php echo $r->__GET('clientes_nombres'); ?></td>
                    <td><?php echo $r->__GET('fecha'); ?></td>
                    <td><?php echo '$ '.number_format($r->__GET('total')); ?></td>
                    <?php $atotal=$atotal+$r->__GET('total'); ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tr>
                  <td colspan="6">Total Venta: </td>
                  <td><?php echo '$ '.number_format($atotal); ?></td>
                </tr>
            </table>
        </div>
    </div>
