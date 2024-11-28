<?php
include_once  "BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_producto, nombre, marca, precio_compra, img, precio_venta,categoria, descripcion FROM producto";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "vistas/parte_superior.php"?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Consultar Productos</h1>
                    

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
                                            <th>Id producto</th>
                                            <th>Nombre</th>
                                            <th>Marca</th>
                                            <th>Precio compra</th>
                                            <th>Imagen</th>
                                            <th>Precio venta</th>
                                            <th>Categoria</th>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th>Id producto</th>
                                            <th>Nombre</th>
                                            <th>Marca</th>
                                            <th>Precio compra</th>
                                            <th>Imagen</th>
                                            <th>Precio Venta</th>
                                            <th>Categoria</th>
                                            <th>Descripción</th>
                                            <th>Acciones</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach($data as $dat) {
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $dat['id_producto'] ?></td>
                                            <td><?php echo $dat['nombre'] ?></td>
                                            <td><?php echo $dat['marca'] ?></td>
                                            <td><?php echo $dat['precio_compra'] ?></td>
                                            <td><img src="<?php echo $dat['img'] ?>"> </img></td>
                                            <td><?php echo $dat['precio_venta'] ?></td>
                                            <td><?php echo $dat['categoria'] ?></td>
                                            <td><?php echo $dat['descripcion'] ?></td>
                                            <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    
                                                    <button class="btn btn-primary" onclick="showEditModal(<?php echo $dat['id_producto'] ?>)">Editar</button>
                                                    <button class="btn btn-danger btnBorrar" onclick="confirmDelete(<?php echo $dat['id_producto'] ?>)">Borrar</button>
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
                        <span>Copyright &copy; PRONTOMUEBELE 2024</span>
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

    <!-- Modal para Editar Producto -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id_producto" name="id_producto">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre:</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_marca">Marca:</label>
                            <input type="text" class="form-control" id="edit_marca" name="marca" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_precio_compra">Precio Compra:</label>
                            <input type="number" class="form-control" id="edit_precio_compra" name="precio_compra" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_img">Imagen (URL):</label>
                            <input type="text" class="form-control" id="edit_img" name="img" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_precio_venta">Precio Venta:</label>
                            <input type="number" class="form-control" id="edit_precio_venta" name="precio_venta" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_categoria">Categoría:</label>
                            <input type="text" class="form-control" id="edit_categoria" name="categoria" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_descripcion">Descripción:</label>
                            <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="4" required></textarea>
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
                    ¿Estás seguro de que deseas eliminar este producto?
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
    function showEditModal(idProducto) {
        $.ajax({
            url: 'operaciones_proveedor/obtener_producto.php',
            type: 'GET',
            data: { id: idProducto },
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene los detalles del producto
                let producto = JSON.parse(response);

                // Rellenar el formulario del modal con los detalles del producto
                $('#edit_id_producto').val(producto.id_producto);
                $('#edit_nombre').val(producto.nombre);
                $('#edit_marca').val(producto.marca);
                $('#edit_precio_compra').val(producto.precio_compra);
                $('#edit_img').val(producto.img);
                $('#edit_precio_venta').val(producto.precio_venta);
                $('#edit_categoria').val(producto.categoria);
                $('#edit_descripcion').val(producto.descripcion);

                // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Hubo un error al obtener los detalles del producto');
            }
        });
    }

    function saveEdit() {
        let idProducto = $('#edit_id_producto').val();
        let formData = $('#editForm').serialize();

        $.ajax({
            url: 'operaciones_proveedor/editar_producto.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene un campo "success"
                let result = JSON.parse(response);
                if (result.success) {
                    alert('Producto actualizado exitosamente');
                    // Cerrar el modal
                    $('#editModal').modal('hide');
                    // Recargar la página
                    location.reload();
                } else {
                    alert('Hubo un error al actualizar el producto');
                }
            },
            error: function() {
                alert('Hubo un error al actualizar el producto');
            }
        });
    }

    //ELIMINAR

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
        url: 'operaciones_proveedor/borrar_producto.php',
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