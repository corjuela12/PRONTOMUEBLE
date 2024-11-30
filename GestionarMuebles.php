<?php
include_once  "BD/conexionMYSQLI.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $Nombre = $_POST['nombre'];
    $Dimension = $_POST['dimension'];
    $Imagen = $_POST['img'];
    $Precio = $_POST['precio'];
    $Stock = $_POST['stock'];
    $CodTipoMueble = $_POST['cod_tipo_mueble'];
    $CodColor = $_POST['cod_color'];
    $CodMaterial = $_POST['cod_material'];

    if (!empty($Nombre) && !empty($Dimension) && !empty($Imagen) && !empty($Precio) && !empty($Stock) && !empty($CodTipoMueble) && !empty($CodColor) && !empty($CodMaterial)) {
        // Aquí puedes cambiar el nombre de la tabla y los campos de acuerdo con tu estructura de base de datos
        $consulta = "INSERT INTO mueble (nombre, dimension, img, precio, stock, cod_tipo_mueble, cod_color, cod_material) 
                     VALUES ('$Nombre', '$Dimension', '$Imagen', '$Precio', '$Stock', '$CodTipoMueble', '$CodColor', '$CodMaterial')";
        if ($enlace->query($consulta) === TRUE) {
            // Redirigir a la misma página con el parámetro de éxito
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit(); // Terminar la ejecución después de la redirección
        } else {
            $mensaje = "Error al insertar mueble: " . $enlace->error;
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

// Mostrar mensaje de éxito si está presente en la URL
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $mensaje = "Mueble insertado correctamente.";
}


// ---------------------------------------------------------------------------------------------------------
//  consultar muebles
$consulta_tel = "SELECT id_mueble, nombre, dimension, img, precio, stock, cod_tipo_mueble, cod_color, cod_material  FROM mueble";
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

                <!-- Agregar Muebles -->

                    <div>
                        <h2 class="m-0 font-weight-bold text-primary text-center">Agregar Muebles</h1>    

                        <div class="container mt-5">
                                <div class="card .bg-gradient-success" style="max-width: 450px; margin: auto;">
                                    <div class="card-header text-center">
                                        <h5 id="exampleModalLabel" class="mb-0 font-weight-bold">Ingrese el mueble</h5>
                                    </div>
                                    <form id="formMuebles" action="" method="post" class="card-body">
                                        <div class="form-group">
                                            <label for="nombre" class="col-form-label">Nombre del mueble:</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="dimension" class="col-form-label">Dimensión:</label>
                                            <input type="text" class="form-control" id="dimension" name="dimension" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="img" class="col-form-label">Imagen (URL):</label>
                                            <input type="text" class="form-control" id="img" name="img" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio" class="col-form-label">Precio de venta:</label>
                                            <input type="number" class="form-control" id="precio" name="precio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock" class="col-form-label">Stock:</label>
                                            <input type="number" class="form-control" id="stock" name="stock" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cod_tipo_mueble" class="col-form-label">Código del tipo de mueble:</label>
                                            <input type="text" class="form-control" id="cod_tipo_mueble" name="cod_tipo_mueble" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cod_color" class="col-form-label">Código del color del mueble:</label>
                                            <input type="text" class="form-control" id="cod_color" name="cod_color" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cod_material" class="col-form-label">Código del material del mueble:</label>
                                            <input type="text" class="form-control" id="cod_material" name="cod_material" required>
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

                    <!-- Consultar Muebles -->

                    <div>
                        <h2 class="m-0 font-weight-bold text-primary text-center mb-5">Consultar Muebles</h1>
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
                                                <th>Id mueble</th>
                                                <th>Nombre</th>
                                                <th>Dimension</th>
                                                <th>Imagen</th>
                                                <th>Precio venta</th>
                                                <th>Stock</th>
                                                <th>Codigo del tipo de mueble</th>
                                                <th>Codigo del color de mueble</th>
                                                <th>Codigo del material de mueble</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>Id mueble</th>
                                                <th>Nombre</th>
                                                <th>Dimension</th>
                                                <th>Imagen</th>
                                                <th>Precio Venta</th>
                                                <th>Stock</th>
                                                <th>Codigo del tipo de mueble</th>
                                                <th>Codigo del color de mueble</th>
                                                <th>Codigo del color de mueble</th>
                                                <th>Acciones</th>

                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach($data as $dat) {
                                            ?>
                                            <tr class="text-center">
                                                <td><?php echo $dat['id_mueble'] ?></td>
                                                <td><?php echo $dat['nombre'] ?></td>
                                                <td><?php echo $dat['dimension'] ?></td>
                                                <td><img src="<?php echo $dat['img'] ?>"> </img></td>
                                                <td><?php echo $dat['precio'] ?></td>
                                                <td><?php echo $dat['stock'] ?></td>
                                                <td><?php echo $dat['cod_tipo_mueble'] ?></td>
                                                <td><?php echo $dat['cod_color'] ?></td>
                                                <td><?php echo $dat['cod_material'] ?></td>
                                                <td>
                                                <div class="text-center">
                                                    <div class="btn-group">
                                                        
                                                        <button class="btn btn-primary" onclick="showEditModal(<?php echo $dat['id_mueble'] ?>)">Editar</button>
                                                        <button class="btn btn-danger btnBorrar" onclick="confirmDelete(<?php echo $dat['id_mueble'] ?>)">Borrar</button>
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
                    <h5 class="modal-title" id="editModalLabel">Editar Mueble</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id_Mueble" name="id_mueble">
                        <!-- Campo Nombre -->
                        <div class="form-group">
                            <label for="edit_nombre">Nombre del mueble:</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        <!-- Campo Dimensión -->
                        <div class="form-group">
                            <label for="edit_dimension">Dimensión del mueble:</label>
                            <input type="text" class="form-control" id="edit_dimension" name="dimension" required>
                        </div>
                        <!-- Campo Imagen -->
                        <div class="form-group">
                            <label for="edit_imagen">Imagen del mueble:</label>
                            <input type="text" class="form-control" id="edit_imagen" name="img" required>
                        </div>
                        <!-- Campo Precio Venta -->
                        <div class="form-group">
                            <label for="edit_precio">Precio de venta:</label>
                            <input type="text" class="form-control" id="edit_precio" name="precio" required>
                        </div>
                        <!-- Campo Stock -->
                        <div class="form-group">
                            <label for="edit_stock">Stock del mueble:</label>
                            <input type="number" class="form-control" id="edit_stock" name="stock" required>
                        </div>
                        <!-- Campo Código Tipo de Mueble -->
                        <div class="form-group">
                            <label for="edit_cod_tipo_mueble">Código del tipo de mueble:</label>
                            <input type="text" class="form-control" id="edit_cod_tipo_mueble" name="cod_tipo_mueble" required>
                        </div>
                        <!-- Campo Código Color -->
                        <div class="form-group">
                            <label for="edit_cod_color">Código del color de mueble:</label>
                            <input type="text" class="form-control" id="edit_cod_color" name="cod_color" required>
                        </div>
                        <!-- Campo Código Material -->
                        <div class="form-group">
                            <label for="edit_cod_material">Código del material de mueble:</label>
                            <input type="text" class="form-control" id="edit_cod_material" name="cod_material" required>
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
                    ¿Estás seguro de que deseas eliminar el mueble?
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

    function showEditModal(idMueble) {
    $.ajax({
        url: 'operaciones_muebles/obtenerMueble.php',
        type: 'GET',
        data: { 
            id_mueble: idMueble,
        },
        success: function(response) {
            // Asumir que la respuesta es JSON y contiene los detalles del mueble
            let mueble = JSON.parse(response);

            // Rellenar el formulario del modal con los detalles del mueble
            $('#edit_id_Mueble').val(mueble.id_mueble);  // Mostrar el id_mueble
            $('#edit_nombre').val(mueble.nombre);  // Nombre del mueble
            $('#edit_dimension').val(mueble.dimension);  // Dimensión del mueble
            $('#edit_imagen').val(mueble.img);  // Imagen del mueble
            $('#edit_precio').val(mueble.precio);  // Precio del mueble
            $('#edit_stock').val(mueble.stock);  // Stock del mueble
            $('#edit_cod_tipo_mueble').val(mueble.cod_tipo_mueble);  // Código del tipo de mueble
            $('#edit_cod_color').val(mueble.cod_color);  // Código del color del mueble
            $('#edit_cod_material').val(mueble.cod_material);  // Código del material del mueble
           
            // Mostrar el modal
            $('#editModal').modal('show');
        },
        error: function() {
            alert('Hubo un error al obtener los detalles del mueble');
        }
        });
    }


    function saveEdit() {
    let formData = $('#editForm').serialize(); // Serializar todo el formulario

        $.ajax({
            url: 'operaciones_muebles/editar_Mueble.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene un campo "success"
                let result = JSON.parse(response);
                if (result.success) {
                    alert('Mueble actualizado exitosamente');
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


    //Borrar Mueble

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
        url: 'operaciones_muebles/borrarMueble.php',
        type: 'POST',
        data: { id: idProducto },
        success: function(response) {
            // Asumir que la respuesta es JSON y contiene un campo "success"
            let result = JSON.parse(response);
            if (result.success) {
                alert('Mueble eliminado exitosamente');
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