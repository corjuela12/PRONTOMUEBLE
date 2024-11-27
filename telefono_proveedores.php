<?php
include_once  "BD/conexionMYSQLI.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $Idproveedor = $_POST['id_prove'];
    $Telefono = $_POST['telefono'];
   

    if (!empty($Idproveedor) && !empty($Telefono)) {
        
        $consulta = "INSERT INTO telefono_proveedor (id_proveedor, telefono_proveedor) VALUES ('$Idproveedor', '$Telefono')";
        
        if ($enlace->query($consulta) === TRUE) {
            // Redirigir a la misma página con el parámetro de éxito
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit(); // Terminar la ejecución después de la redirección
        } else {
            $mensaje = "Error al insertar proveedor: " . $enlace->error;
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

// Mostrar mensaje de éxito si está presente en la URL
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $mensaje = "Proveedor insertado correctamente.";
}

// ---------------------------------------------------------------------------------------------------------

$consulta_tel = "SELECT telefono_proveedor, id_proveedor FROM telefono_proveedor";
$resultado_tel = $enlace->query($consulta_tel);

$data = array();
if ($resultado_tel->num_rows > 0) {
    while ($fila = $resultado_tel->fetch_assoc()) {
        $data[] = $fila;
    }
}

?>

<?php require_once "vistas/parte_superior.php"?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Agregar telefono proveedor -->

                    <div>
                        <h2 class="m-0 font-weight-bold text-primary text-center">Agregar telefono Proveedores</h1>    

                        <div class="container mt-5">
                                <div class="card .bg-gradient-success" style="max-width: 450px; margin: auto;">
                                    <div class="card-header text-center">
                                        <h5 id="exampleModalLabel" class="mb-0 font-weight-bold">Ingrese telefono Proveedor</h5>
                                    </div>
                                    <form id="formProductos" action="" method="post" class="card-body">
                                        <div class="form-group">
                                            <label for="nombre" class="col-form-label">Id del proveedor:</label>
                                            <input type="text" class="form-control" id="id_prove" name="id_prove" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono" class="col-form-label">Telefono:</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-secondary mr-2">Restablecer</button>
                                            <button type="submit" id="btnGuardar" class="btn btn-success" name="enviar">Guardar</button>
                                        </div>
                                    </form>
                                    <?php if (!empty($mensaje)) : ?>
                                        <div class="alert alert-info mt-3 alert-dismissible fade show" role="alert">
                                            <?php echo $mensaje; ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <!-- Consultar telefono proveedor -->

                    <div>
                        <h2 class="m-0 font-weight-bold text-primary text-center mb-5">Consultar telefonos de proveedores</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <!--<div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-center"></h6>
                            </div>-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Id Proveedor</th>
                                                <th>Telefono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>Id Proveedor</th>
                                                <th>Telefono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach($data as $dat) {
                                            ?>
                                            <tr class="text-center">
                                                <td><?php echo $dat['id_proveedor'] ?></td>
                                                <td><?php echo $dat['telefono_proveedor'] ?></td>
                                                <td>
                                                <div class="text-center">
                                                    <div class="btn-group">
                                                        <button 
                                                            class="btn btn-primary" 
                                                            onclick="showEditModal('<?php echo $dat['id_proveedor'] ?>', '<?php echo $dat['telefono_proveedor'] ?>')">
                                                            Editar
                                                        </button>
                                                        
                                                        <button class="btn btn-danger btnBorrar" 
                                                        onclick="confirmDelete(<?php echo $dat['telefono_proveedor'] ?>)">
                                                        Borrar
                                                        </button>
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
                <div class="modal-body">Selecciona salir para cerrar sesion</div>
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
                    <h5 class="modal-title" id="editModalLabel">Editar Teléfono del Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id_proveedor" name="id_proveedor">
                        <input type="hidden" id="original_telefono_proveedor" name="original_telefono_proveedor">
                        <div class="form-group">
                            <label for="edit_telefono">Teléfono proveedor:</label>
                            <input type="text" class="form-control" id="edit_telefono" name="telefono_proveedor" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" onclick="saveEdit()">Guardar Cambios</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
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
                    ¿Estás seguro de que deseas eliminar el telefono del proveedor?
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
    function showEditModal(idProveedor, telefonoProveedor) {
        $.ajax({
            url: 'operaciones_telefono_proveedor/obtener_tel_prove.php',
            type: 'GET',
            data: { 
                id_proveedor: idProveedor, 
                telefono_proveedor: telefonoProveedor 
            },
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene los detalles del teléfono
                let telefono_proveedor = JSON.parse(response);

                // Rellenar el formulario del modal con los detalles del teléfono
                $('#edit_id_proveedor').val(telefono_proveedor.id_proveedor);  // Mostrar el id_proveedor
                $('#original_telefono_proveedor').val(telefono_proveedor.telefono_proveedor); // Valor original del teléfono
                $('#edit_telefono').val(telefono_proveedor.telefono_proveedor);  // Mostrar el teléfono

                // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Hubo un error al obtener los detalles del teléfono');
            }
        });
    }

    function saveEdit() {
    let formData = $('#editForm').serialize(); // Serializar todo el formulario

        $.ajax({
            url: 'operaciones_telefono_proveedor/editar_tel_prove.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene un campo "success"
                let result = JSON.parse(response);
                if (result.success) {
                    alert('Teléfono del proveedor actualizado exitosamente');
                    // Cerrar el modal
                    $('#editModal').modal('hide');
                    // Recargar la página
                    location.reload();
                } else {
                    alert('Hubo un error al actualizar el teléfono');
                }
            },
            error: function() {
                alert('Hubo un error al actualizar el teléfono');
            }
        });
    }


    //Borrar telefono proveedor

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
        url: 'operaciones_telefono_proveedor/borrar_telefono_prove.php',
        type: 'POST',
        data: { id: idProducto },
        success: function(response) {
            // Asumir que la respuesta es JSON y contiene un campo "success"
            let result = JSON.parse(response);
            if (result.success) {
                alert('telefono proveedor eliminado exitosamente');
                // Recargar la página
                location.reload();
            } else {
                alert('Hubo un error al eliminar el telefono del proveedor');
            }
        },
        error: function() {
            alert('Hubo un error al eliminar el producto');
        }
    });
    }
    </script>
    <!-- Código JavaScript para eliminar el parámetro 'success' -->
    <script>
        const url = new URL(window.location.href);
        url.searchParams.delete("success");
        window.history.replaceState({}, document.title, url);
    </script>


</body>

</html>