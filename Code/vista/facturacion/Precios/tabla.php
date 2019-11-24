<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Precios De Venta De Productos</h1>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Embalaje</th>
                  <th>Categoria</th>
                  <th>Producto Nombre</th>
                  <th>Iva %</th>
                  <th>Precio Venta</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Embalaje</th>
                  <th>Categoria</th>
                  <th>Producto Nombre</th>
                  <th>Iva %</th>
                  <th>Precio Venta</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($modelPrecio_venta->Listar_Activos() as $r): ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('embalaje_det'); ?></td>
                    <td><?php echo $r->__GET('categorias_det'); ?></td>
                    <td><?php echo $r->__GET('productos_nombre'); ?></td>
                    <td><?php echo $r->__GET('iva_det').'%'; ?></td>
                    <td align="right"><b><?php echo '$ '.number_format($r->__GET('neto')); ?></b></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>