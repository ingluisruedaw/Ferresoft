<div id="page-wrapper" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado De Usuarios Activos</h1>
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
                  <th>Usuario</th>
                  <th>Rol Id</th>
                  <th>Rol Det</th>
                  <th>Empleado Id</th>
                  <th>Empleado Cargo</th>
                  <th>Empleado Nombre</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Usuario</th>
                  <th>Rol Id</th>
                  <th>Rol Det</th>
                  <th>Empleado Id</th>
                  <th>Empleado Cargo</th>
                  <th>Empleado Nombre</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($modelUsuario->Listar_Activos() as $r): 
                  $captureU = $r->__GET('usuario');
                ?>
                  <tr>
                    <td><?php echo $captureU; ?></td>
                    <td><?php echo $r->__GET('roles_id'); ?></td>
                    <td><?php echo $r->__GET('roles_det'); ?></td>
                    <td><?php echo $r->__GET('empleados_id'); ?></td>
                    <td><?php echo $r->__GET('empleados_cargo'); ?></td>
                    <td><?php echo $r->__GET('empleados_nombres'); ?></td>
                    <td>
                      <button type="submit" class="botones" id="botonActualizar" data-toggle="modal" data-target="#ModalUActializacion" onclick="setEstados('234','<?php echo $r->__GET('roles_id');?>','<?php echo $r->__GET('empleados_id');?>')">Actualizar</button>
                    </td>
                    <td>
                      <button type="submit" class="botones" id="botonEliminar" onclick="eliminar('<?php echo $r->__GET('usuario');?>')">Eliminar</button>
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