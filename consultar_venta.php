<?php
include_once  "BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM Venta";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "vistas/parte_superior.php"?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Consultar Venta</h1>
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id Venta</th>
                                            <th>Nombre del Venta</th>
                                            <th>Atributo2</th>
                                            <th>Atributo3</th>
                                            <th>Atributo4</th>
                                            <th>Atributo5</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th>Id Venta</th>
                                            <th>Nombre del Venta</th>
                                            <th>Atributo2</th>
                                            <th>Atributo3</th>
                                            <th>Atributo4</th>
                                            <th>Atributo5</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach($data as $dat) {
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $dat['id_Venta'] ?></td>
                                            <td><?php echo $dat['nombre'] ?></td>
                                            <td><?php echo $dat['Atributo2'] ?></td>
                                            <td><?php echo $dat['Atributo3'] ?></td>
                                            <td><?php echo $dat['Atributo4'] ?></td>
                                            <td><?php echo $dat['Atributo5'] ?></td>
                                            <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary" onclick="showEditModal(<?php echo $dat['id_Venta'] ?>)">Editar</button>
                                                    <button class="btn btn-danger btnBorrar" onclick="confirmDelete(<?php echo $dat['id_Venta'] ?>)">Borrar</button>
                                                    <button class="btn btn-warning btnDetalle" onclick="showDetalleVenta(<?php echo $dat['id_Venta'] ?>)">Detalle Venta</button>
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
                    <h5 class="modal-title" id="editModalLabel">Editar Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id_Venta" name="id_Venta">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre del Venta:</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_Atributo2">Atributo2:</label>
                            <input type="text" class="form-control" id="edit_Atributo2" name="Atributo2" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_Atributo3">Atributo3:</label>
                            <input type="text" class="form-control" id="edit_Atributo3" name="Atributo3" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_Atributo4">Atributo4:</label>
                            <input type="text" class="form-control" id="edit_Atributo4" name="Atributo4" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_Atributo5">Atributo5:</label>
                            <input type="text" class="form-control" id="edit_Atributo5" name="Atributo5" required>
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
                    ¿Estás seguro de que deseas eliminar este Venta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="#" id="deleteButton" class="btn btn-danger">Borrar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar el detalle de la venta -->
    <div class="modal fade" id="detalleVentaModal" tabindex="-1" aria-labelledby="detalleVentaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleVentaLabel">Detalle de la Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se cargará dinámicamente el contenido -->
                    <div id="detalleVentaContenido">
                        <p class="text-center">Cargando información...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

    // Detalle de la venta
    function showDetalleVenta(idVenta) {
        // Mostrar el modal
        var modal = new bootstrap.Modal(document.getElementById('detalleVentaModal'));
        modal.show();

        // Cargar los datos de la venta usando AJAX
        $.ajax({
            url: 'getDetalleVenta.php', // Archivo PHP que procesará la solicitud
            type: 'GET',
            data: { idVenta: idVenta }, // Enviar el ID de la venta
            success: function(response) {
                // Mostrar la información en el modal
                $('#detalleVentaContenido').html(response);
            },
            error: function() {
                // Mostrar un mensaje de error
                $('#detalleVentaContenido').html('<p class="text-danger text-center">Error al cargar los datos de la venta.</p>');
            }
        });
    }

     // EDITAR
     function showEditModal(idVenta) {
        $.ajax({
            url: 'operaciones_Venta/obtener_Venta.php',
            type: 'GET',
            data: { id: idVenta },
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene los detalles del Venta
                let Venta = JSON.parse(response);

                // Rellenar el formulario del modal con los detalles del Venta
                $('#edit_id_Venta').val(Venta.id_Venta);
                $('#edit_nombre').val(Venta.nombre);
                $('#edit_Atributo2').val(Venta.Atributo2);
                $('#edit_Atributo3').val(Venta.Atributo3);
                $('#edit_Atributo4').val(Venta.Atributo4);
                $('#edit_Atributo5').val(Venta.Atributo5);
                // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Hubo un error al obtener los detalles del Venta');
            }
        });
    }

    function saveEdit() {
        let formData = $('#editForm').serialize();

        $.ajax({
            url: 'operaciones_Venta/editar_Venta.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene un campo "success"
                let result = JSON.parse(response);
                if (result.success) {
                    alert('Venta actualizado exitosamente');
                    // Cerrar el modal
                    $('#editModal').modal('hide');
                    // Recargar la página
                    location.reload();
                } else {
                    alert('Hubo un error al actualizar el Venta');
                }
            },
            error: function() {
                alert('Hubo un error al actualizar el Venta');
            }
        });
    }

    //Borrar Venta
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
    </script>
</body>
</html>