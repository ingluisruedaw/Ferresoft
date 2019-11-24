<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Facturas Activas</h1>
                </div>
                <div>
                  <button type="submit" id="botonAgregar" data-toggle="modal" data-target="#modalPrepararFactura">Facturar</button>
                  <br><br>
                    <form method="POST" action="http://10.0.10.229/~ferresoft/vista/dashboard/reporte_factura.php" target="_blank">
                      <input type="text" name="idfactura">
                      <input type="hidden" name="idusuarioe" value="<?php echo $_SESSION['username']; ?>">
                      <button type="submit" id="botonAgregar">Imprimir Factura
                    </button>
                    </form>
                    <br><br>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>                
                  <th>Id</th>
                  <th>Cliente Nombres</th>
                  <th>Fecha</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Cliente Nombres</th>
                  <th>Fecha</th>
                  <th>Total</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($modelFactura->Listar_ActivosPorEmpleado($_SESSION['empleado_id']) as $r):  ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('clientes_nombres'); ?></td>
                    <td><?php echo $r->__GET('fecha'); ?></td>
                    <td><?php echo '$ '.number_format($r->__GET('total')); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
    <?php require('ModalPreparar.php'); ?>
