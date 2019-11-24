<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Factura En Proceso # <?php echo $_SESSION['factura']; ?></h1>
                </div>
                <div>
                    <button type="submit" id="botonAgregar" data-toggle="modal" data-target="#ModalAgregar">Agregar Productos</button>
                    <button type="submit" class="botones" id="botonEliminar" data-toggle="modal" data-target="#modalCobrar">Cobrar Productos</button>
                    <br><br>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>                
                  <th>Id</th>
                  <th>Categoria</th>
                  <th>Embalaje</th>
                  <th>Producto</th>
                  <th>Iva</th>
                  <th>Precio Venta</th>
                  <th>Iva Pagado</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Categoria</th>
                  <th>Embalaje</th>
                  <th>Producto</th>
                  <th>Iva</th>
                  <th>Precio Venta</th>
                  <th>Iva Pagado</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                </tr>
              </tfoot>
              <tbody>
              <?php 
                $atotal=0; 
                $siniva=0;
                $sumasiva=0;
              ?>
                <?php foreach($modelFactura->Listar_Temporales($_SESSION['factura']) as $r): ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('categoria_det'); ?></td>
                    <td><?php echo $r->__GET('embalaje_det'); ?></td>
                    <td><?php echo $r->__GET('productos_nombre'); ?></td>
                    <td><?php echo $r->__GET('iva_det'); ?></td>

                    <?php  
                      $siniva = $r->__GET('precio_venta_neto')/1.30;///200
                      $preciosinganancia =$siniva;//200
                      $siniva = round($r->__GET('cantidad')*($preciosinganancia-($preciosinganancia/(1+($r->__GET('iva_det')/100)))),2); 
                    ?>
                    <td><?php echo '$ '.number_format($r->__GET('precio_venta_neto')); ?></td>
                    <td><?php echo '$ '.number_format($siniva); ?></td>
                    <?php $sumasiva=$sumasiva+$siniva; ?>
                    <td><?php echo $r->__GET('cantidad'); ?></td>
                    <td><?php echo '$ '.number_format($r->__GET('total')); ?></td>
                    <?php $atotal=$atotal+$r->__GET('total'); ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tr>
                <td colspan="7" align="right" style="color: red;"><b>Subtotal: </b></td>
                <td colspan="2" align="right" style="color: blue;"><b><?php echo '$ '.number_format($atotal-$sumasiva); ?></b></td>
              </tr>
              <tr>
                <td colspan="7" align="right" style="color: red"><b>Total Iva Pagado: </b></td>
                <td colspan="2" align="right" style="color: blue;"><b><?php echo '$ '.number_format($sumasiva); ?></b></td>
              </tr>
              <tr>
                <td colspan="7" align="right" style="color: red"><b>Total Venta: </b></td>
                <td colspan="2" align="right" style="color: blue;"><b><?php echo '$ '.number_format($atotal); ?></b></td>
              </tr>
            </table>
        </div>
    </div>
    <?php require('agregar.php'); ?>
    <?php require('cobrar.php'); ?>