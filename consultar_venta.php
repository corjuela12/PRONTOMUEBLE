<?php require_once "vistas/parte_superior.php"?>

<?php
include_once  "BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM VENTAS";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>
                <!-- Begin Page Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">            
                        <button id="btnNuevaVenta" type="button" class="btn btn-success" data-toggle="modal" data-target="#createVentaModal">Nueva Venta</button>
                        </div>
                    </div>
                </div>
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
                                        <th>Fecha Registro</th>
                                        <th>Id Vendedor</th>
                                        <th>Id Cliente</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($data as $dat) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $dat['id_venta'] ?></td>
                                        <td><?php echo $dat['fecha'] ?></td>
                                        <td><?php echo $dat['id_vendedor'] ?></td>
                                        <td><?php echo $dat['id_cliente'] ?></td>
                                        <td><?php echo $dat['total'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary" onclick="showEditModal(<?php echo $dat['id_venta'] ?>)">Editar</button>
                                                    <button class="btn btn-danger btnBorrar" onclick="confirmDelete(<?php echo $dat['id_venta'] ?>)">Borrar</button>
                                                    <button class="btn btn-warning btnDetalle" onclick="showDetalleVenta(<?php echo $dat['id_venta'] ?>)">Detalle Venta</button>
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

    <!-- Modal crear -->
    <div class="modal fade" id="createVentaModal" tabindex="-1" role="dialog" aria-labelledby="createVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVentaModalLabel">Registrar Nueva Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createVentaForm">
                    <div class="form-group">
                        <label for="create_id_vendedor">Id Vendedor:</label>
                        <input type="number" class="form-control" id="create_id_vendedor" name="id_vendedor" required>
                    </div>
                    <div class="form-group">
                        <label for="create_id_cliente">Id Cliente:</label>
                        <input type="number" class="form-control" id="create_id_cliente" name="id_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="create_total">Total:</label>
                        <input type="number" class="form-control" id="create_total" name="total" required>
                    </div>
                    <div class="form-group">
                        <label for="create_fecha">Fecha de Registro:</label>
                        <input type="date" class="form-control" id="create_fecha" name="fecha" 
                            value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveVenta()">Guardar Venta</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
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
                        <input type="hidden" id="edit_id_venta" name="id_venta">
                        <div class="form-group">
                            <label for="edit_fecha">Fecha:</label>
                            <input type="date" class="form-control" id="edit_fecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_id_vendedor">Id Vendedor:</label>
                            <input type="text" class="form-control" id="edit_id_vendedor" name="id_vendedor" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_id_cliente">Id Cliente:</label>
                            <input type="text" class="form-control" id="edit_id_cliente" name="id_cliente" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_total">Total:</label>
                            <input type="text" class="form-control" id="edit_total" name="total" required>
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
                ¿Estás seguro de que deseas eliminar esta Venta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="deleteButton" class="btn btn-danger">Borrar</button>
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
    function showDetalleVenta(id_venta) {
        console.log("ID de Venta: " + id_venta);  // Agrega esto para verificar
        // Mostrar el modal
        var modal = new bootstrap.Modal(document.getElementById('detalleVentaModal'));
        modal.show();

        // Cargar los datos de la venta usando AJAX
        $.ajax({
            url: 'getDetalleVenta.php',
            type: 'GET',
            data: { id_venta: id_venta },
            success: function(response) {
                console.log(response);  // Agrega esto para ver la respuesta
                $('#detalleVentaContenido').html(response);
            },
            error: function() {
                $('#detalleVentaContenido').html('<p class="text-danger text-center">Error al cargar los datos de la venta.</p>');
            }
        });
    }


    //Nueva venta
    function saveVenta() {
    let formData = $('#createVentaForm').serialize();

    $.ajax({
        url: 'operaciones_venta/crear_venta.php', // Archivo PHP que manejará la creación
        type: 'POST',
        data: formData,
        success: function(response) {
            try {
                let result = JSON.parse(response);
                if (result.success) {
                    alert('Venta creada exitosamente');
                    // Cerrar el modal
                    $('#createVentaModal').modal('hide');
                    // Recargar la página para actualizar la tabla
                    location.reload();
                } else {
                    console.error("Error al crear la venta:", result.error);
                    alert('Hubo un error al crear la venta');
                }
            } catch (e) {
                console.error("Error al procesar la respuesta del servidor:", e);
                alert('Hubo un error al procesar la respuesta del servidor');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
            alert('Hubo un error al registrar la venta');
        }
    });
}

     // EDITAR
     function showEditModal(id_venta) {
        $.ajax({
            url: 'operaciones_venta/obtener_venta.php',
            type: 'GET',
            data: { id: id_venta },
            success: function(response) {
                console.log("Respuesta del servidor: ", response); // Ver qué se está devolviendo
                try {
                    let venta = JSON.parse(response);

                    if (venta.error) {
                        alert('Error: ' + venta.error);
                        return;
                    }

                    // Rellenar el formulario con los detalles de la venta
                    $('#edit_id_venta').val(venta.id_venta);
                    $('#edit_id_vendedor').val(venta.id_vendedor);
                    $('#edit_id_cliente').val(venta.id_cliente);
                    $('#edit_total').val(venta.total);
                    $('#edit_fecha').val(venta.fecha); // Fecha en formato AAAA-MM-DD
                    $('#editModal').modal('show');
                } catch (error) {
                    alert('Error al procesar la respuesta JSON: ' + error.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Hubo un error al obtener los detalles de la venta. Estado: ' + status + ', Error: ' + error);
            }
        });
    }

    function saveEdit() {
    let formData = $('#editForm').serialize();

    $.ajax({
        url: 'operaciones_venta/editar_venta.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            let result = JSON.parse(response);
            if (result.success) {
                alert('Venta actualizada exitosamente');
                $('#editModal').modal('hide');
                location.reload();
            } else {
                alert('Error al actualizar la venta: ' + result.error);
            }
        },
        error: function() {
            alert('Hubo un error al actualizar la venta');
        }
    });
}

// Función para mostrar el modal de confirmación y guardar el ID de la venta
function confirmDelete(id_venta) {
    // Guardar el ID de la venta en una variable global o en algún atributo del modal
    ventaToDelete = id_venta;  // Variable global para almacenar el ID de la venta
    $('#confirmDeleteModal').modal('show');  // Mostrar el modal de confirmación
}

    //Borrar Venta
    let ventaToDelete = null; // Variable para almacenar la venta que se va a eliminar

    // Mostrar el modal de confirmación de eliminación
    function showDeleteModal(id_venta) {
        ventaToDelete = id_venta;  // Almacenar el ID de la venta que se va a eliminar
        $('#confirmDeleteModal').modal('show');  // Mostrar el modal
    }

    // Eliminar la venta
    $('#deleteButton').on('click', function() {
        if (ventaToDelete !== null) {
            $.ajax({
                url: 'operaciones_venta/eliminar_venta.php',  // Ruta del archivo PHP para eliminar la venta
                type: 'POST',
                data: { id_venta: ventaToDelete },
                success: function(response) {
                    let result = JSON.parse(response);
                    if (result.success) {
                        alert('Venta eliminada exitosamente');
                        $('#confirmDeleteModal').modal('hide');
                        location.reload();  // Recargar la página para actualizar la lista
                    } else {
                        alert('Error al eliminar la venta: ' + result.error);
                    }
                },
                error: function() {
                    alert('Hubo un error al intentar eliminar la venta');
                }
            });
        }
    });


    </script>

<?php include('vistas/parte_inferior.php'); ?>