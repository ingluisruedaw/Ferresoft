<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Productos</h1>
                </div>
                <div>
                    <button type="submit" id="botonAgregar" data-toggle="modal" data-target="#ModalNuevo">Agregar
                    </button>
                    <a href="http://10.0.10.229/~ferresoft/vista/dashboard/reporte_kardex.php" target="_blank" id="botonAgregar">Exportar</a>
                        <br><br>
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
                  <th>Actualizar</th>
                  <th>Eliminar</th>
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
                  <th>Actualizar</th>
                  <th>Eliminar</th>
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
                    <td>
                      <button type="submit" class="botones" id="botonActualizar" data-toggle="modal" data-target="#ModalActualizar" onclick="setEstados('<?php echo $r->__GET('id');?>','<?php echo $r->__GET('nombre');?>','<?php echo $r->__GET('stockmin');?>','<?php echo $r->__GET('embalaje_id');?>','<?php echo $r->__GET('categorias_id');?>')">Actualizar</button>
                    </td>
                    <td>
                      <button type="submit" class="botones" id="botonEliminar" onclick="eliminar('<?php echo $r->__GET('id');?>')">Eliminar</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
    <?php  require('insertar.php');?>
    <?php  require('actualizar.php');?>
    <?php  require('eliminar.php');?>

