<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Proveedores</h1>
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
                  <th>Proveedor</th>
                  <th>Dirección</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Proveedor</th>
                  <th>Dirección</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($modelProveedor->Listar_Activos() as $r):
                ?>
                  <tr>
                    <td><?php echo $r->__GET('id'); ?></td>
                    <td><?php echo $r->__GET('det'); ?></td>
                    <td><?php echo $r->__GET('direccion'); ?></td>
                    <td><?php echo $r->__GET('telefono'); ?></td>
                    <td><?php echo $r->__GET('email'); ?></td>
                    <td>
                      <button type="submit" class="botones" id="botonActualizar" data-toggle="modal" data-target="#ModalActualizar" onclick="setEstados('<?php echo $r->__GET('id');?>','<?php echo $r->__GET('det');?>','<?php echo $r->__GET('direccion');?>','<?php echo $r->__GET('telefono');?>','<?php echo $r->__GET('email');?>')">Actualizar</button>
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