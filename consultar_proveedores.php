<?php
/*include_once  "BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_proveedor, nombre, direccion, persona_contacto FROM proveedor";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);*/

include_once  "BD/conexionMYSQLI.php";
$consulta = "SELECT id_proveedor, nombre, direccion, persona_contacto FROM proveedor";
$resultado = $enlace->query($consulta);

$data = array();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $data[] = $fila;
    }
}

?>

<?php require_once "vistas/parte_superior.php"?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Consultar Proveedores</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!--<div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id Proveedor</th>
                                            <th>Nombre de la empresa</th>
                                            <th>Dirección</th>
                                            <th>Persona de contacto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th>Id Proveedor</th>
                                            <th>Nombre de la empresa</th>
                                            <th>Dirección</th>
                                            <th>Persona de contacto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach($data as $dat) {
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $dat['id_proveedor'] ?></td>
                                            <td><?php echo $dat['nombre'] ?></td>
                                            <td><?php echo $dat['direccion'] ?></td>
                                            <td><?php echo $dat['persona_contacto'] ?></td>
                                            <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary" onclick="showEditModal(<?php echo $dat['id_proveedor'] ?>)">Editar</button>
                                                    <button class="btn btn-danger btnBorrar" onclick="confirmDelete(<?php echo $dat['id_proveedor'] ?>)">Borrar</button>
                                                </div>
                                            </div>

                                            </td>
                                            
                                        </tr>
                                        
                                        <?php
                                        }
                                        ?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PRONTOMUEBLE 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona salir para cerrar sesion.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="login.php">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id_proveedor" name="id_proveedor">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre de la empresa:</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_direccion">Dirección:</label>
                            <input type="text" class="form-control" id="edit_direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_persona_contacto">Persona de contacto:</label>
                            <input type="text" class="form-control" id="edit_persona_contacto" name="persona_contacto" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="saveEdit()">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                         
    
    <!-- Modal borrar -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este proveedor?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="#" id="deleteButton" class="btn btn-danger">Borrar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
    
     // EDITAR
     function showEditModal(idProveedor) {
        $.ajax({
            url: 'operaciones_proveedor/obtener_proveedor.php',
            type: 'GET',
            data: { id: idProveedor },
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene los detalles del proveedor
                let proveedor = JSON.parse(response);

                // Rellenar el formulario del modal con los detalles del proveedor
                $('#edit_id_proveedor').val(proveedor.id_proveedor);
                $('#edit_nombre').val(proveedor.nombre);
                $('#edit_direccion').val(proveedor.direccion);
                $('#edit_persona_contacto').val(proveedor.persona_contacto);
                // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Hubo un error al obtener los detalles del proveedor');
            }
        });
    }

    function saveEdit() {
        //let idProveedor = $('#edit_id_proveedor').val();
        let formData = $('#editForm').serialize();

        $.ajax({
            url: 'operaciones_proveedor/editar_proveedor.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene un campo "success"
                let result = JSON.parse(response);
                if (result.success) {
                    alert('Proveedor actualizado exitosamente');
                    // Cerrar el modal
                    $('#editModal').modal('hide');
                    // Recargar la página
                    location.reload();
                } else {
                    alert('Hubo un error al actualizar el proveedor');
                }
            },
            error: function() {
                alert('Hubo un error al actualizar el proveedor');
            }
        });
    }

    //Borrar proveedor

    // Función para mostrar el modal de confirmación de eliminación
    function confirmDelete(idProducto) {
        // Actualizar el href del botón Borrar en el modal para que apunte al script de borrado con el ID del producto
        
        let deleteButton = document.getElementById("deleteButton");
            deleteButton.onclick = function() {
            deleteProduct(idProducto);
        };
        // Mostrar el modal de confirmación
        $('#confirmDeleteModal').modal('show');
    }

    function deleteProduct(idProducto) {
        console.log(idProducto);
    // Enviar la solicitud de eliminación mediante AJAX
    $.ajax({
        url: 'operaciones_proveedor/borrar_proveedor.php',
        type: 'POST',
        data: { id: idProducto },
        success: function(response) {
            // Asumir que la respuesta es JSON y contiene un campo "success"
            let result = JSON.parse(response);
            if (result.success) {
                alert('Producto eliminado exitosamente');
                // Recargar la página
                location.reload();
            } else {
                alert('Hubo un error al eliminar el producto');
            }
        },
        error: function() {
            alert('Hubo un error al eliminar el producto');
        }
    });
    }
    </script>

</body>

</html>