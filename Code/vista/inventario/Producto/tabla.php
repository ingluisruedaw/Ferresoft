<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Productos</h1>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Producto</th>
                  <th>Stock</th>
                  <th>Emb. Id</th>
                  <th>Emb. Det</th>
                  <th>Cat. Id</th>
                  <th>Cat. Det</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Producto</th>
                  <th>Stock</th>
                  <th>Emb. Id</th>
                  <th>Emb. Det</th>
                  <th>Cat. Id</th>
                  <th>Cat. Det</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($modelProductos->Listar_Activos() as $r): ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('nombre'); ?></td>
                    <td><?php echo $r->__GET('stockmin'); ?></td>
                    <td><?php echo $r->__GET('embalaje_id'); ?></td>
                    <td><?php echo $r->__GET('embalaje_det'); ?></td>
                    <td><?php echo $r->__GET('categorias_id'); ?></td>
                    <td><?php echo $r->__GET('categorias_det'); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>

