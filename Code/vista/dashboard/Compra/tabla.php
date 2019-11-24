<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Compras Realizadas A Los Proveedores</h1>
                </div>
                <div>
                    <button type="submit" id="botonAgregar" data-toggle="modal" data-target="#ModalNuevo">Agregar
                    </button>
                        <br><br>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th>Proveedor</th>
                  <th>Precio</th>
                  <th>Iva</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th>Proveedor</th>
                  <th>Precio</th>
                  <th>Iva</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th>Fecha</th>
                </tr>
              </tfoot>
              <tbody>
              <?php $temp=0; $tot=0; ?>
                <?php foreach($modelCompras->Listar_Activos() as $r): /*$fechaformato = new DateTime();*/ ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('productos_nombre'); ?></td>
                    <td><?php echo $r->__GET('productos_categorias_det'); ?></td>
                    <td><?php echo $r->__GET('proveedores_det'); ?></td>
                    <td align="right"><?php echo '$ '.number_format($r->__GET('precio')); ?></td>
                    <td><?php echo $r->__GET('iva_det').'%'; ?></td>
                    <td><?php echo $r->__GET('cantidad'); ?></td>
                    <?php 
                      $tot=$r->__GET('cantidad') * $r->__GET('precio');
                    ?>
                    <td align="right"><?php echo '$ '.number_format($tot); ?></td>
                    <td><?php /*echo $fechaformato->format('Y-m-d');*/echo $r->__GET('fecha'); ?></td>
                    <?php 
                      $temp=$temp+$tot;
                    ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tr>
                <td colspan="4" align="right"><b>Total Compras: </b></td>
                <td align="right" colspan="4"><b><?php echo '$ '.number_format($temp); ?></b></td>
                <td colspan="1" align="right"></td>
              </tr>
            </table>

        </div>
    </div>
    <?php  require('insertar.php');?>
