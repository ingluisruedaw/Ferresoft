<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detalle De La Factura # <?php echo $_REQUEST['ver_factura_id'];?></h1>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>                
                  <th>Id</th>
                  <th>Embalaje</th>
                  <th>Producto</th>
                  <th>Iva</th>
                  <th>Precio Venta</th>
                  <th>Cantidad</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($modelFactura->Listar_Detalle_Factura($_REQUEST['ver_factura_id']) as $r): 
                ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('embalaje_det'); ?></td>
                    <td><?php echo $r->__GET('productos_nombre'); ?></td>
                    <td><?php echo $r->__GET('iva_det').'%'; ?></td>
                    <td><?php echo '$ '.number_format($r->__GET('precio_venta_neto')); ?></td>
                    <td><?php echo $r->__GET('cantidad'); ?></td>
                    <td><?php echo '$ '.number_format($r->__GET('total')); ?></td>                    
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
