<?php require_once "vistas/parte_superior.php"?>

<?php
include_once  "BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM VENDEDORES";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>
                <!-- Begin Page Content -->

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">            
                        <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">Nuevo Vendedor</button>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Consultar Vendedor</h1>
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dt_vendedor" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id Vendedor</th>
                                            <th>Nombre del vendedor</th>
                                            <th>Telefono</th>
                                            <th>Direccion</th>
                                            <th>Email</th>
                                            <th>Genero</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($data as $dat) {
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $dat['id_vendedor'] ?></td>
                                            <td><?php echo $dat['nombre'] ?></td>
                                            <td><?php echo $dat['telefono'] ?></td>
                                            <td><?php echo $dat['direccion'] ?></td>
                                            <td><?php echo $dat['email'] ?></td>
                                            <td><?php echo $dat['genero'] ?></td>
                                            <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary" onclick="showEditModal(<?php echo $dat['id_vendedor'] ?>)">Editar</button>
                                                    <button class="btn btn-danger btnBorrar" onclick="confirmDelete(<?php echo $dat['id_vendedor'] ?>)">Borrar</button>
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

    <!-- Modal Crear -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Nuevo Vendedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        <div class="form-group">
                            <label for="create_nombre">Nombre del vendedor:</label>
                            <input type="text" class="form-control" id="create_nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="create_telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="create_telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="create_direccion">Dirección:</label>
                            <input type="text" class="form-control" id="create_direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="create_email">Email:</label>
                            <input type="email" class="form-control" id="create_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="create_genero">Género:</label>
                            <select class="form-control" id="create_genero" name="genero" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="saveCreate()">Guardar</button>
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
                    <h5 class="modal-title" id="editModalLabel">Editar Vendedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id_vendedor" name="id_vendedor">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre del vendedor:</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_telefono">telefono:</label>
                            <input type="text" class="form-control" id="edit_telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_direccion">direccion:</label>
                            <input type="text" class="form-control" id="edit_direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">email:</label>
                            <input type="text" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_genero">genero:</label>
                            <input type="text" class="form-control" id="edit_genero" name="genero" required>
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
                    ¿Estás seguro de que deseas eliminar este vendedor?
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
    function saveCreate() {
        let formData = $('#createForm').serialize();

        $.ajax({
            url: 'operaciones_vendedor/crear_vendedor.php', // Cambia por tu ruta correspondiente
            type: 'POST',
            data: formData,
            success: function(response) {
                let result = JSON.parse(response);
                if (result.success) {
                    alert('Vendedor creado exitosamente');
                    // Cerrar el modal
                    $('#createModal').modal('hide');
                    // Recargar la página
                    location.reload();
                } else {
                    alert('Hubo un error al crear el vendedor');
                }
            },
            error: function() {
                alert('Hubo un error al procesar la solicitud');
            }
        });
    }

     // EDITAR
     function showEditModal(idvendedor) {
        $.ajax({
            url: 'operaciones_vendedor/obtener_vendedor.php',
            type: 'GET',
            data: { id: idvendedor },
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene los detalles del vendedor
                let vendedor = JSON.parse(response);

                // Rellenar el formulario del modal con los detalles del vendedor
                $('#edit_id_vendedor').val(vendedor.id_vendedor);
                $('#edit_nombre').val(vendedor.nombre);
                $('#edit_telefono').val(vendedor.telefono);
                $('#edit_direccion').val(vendedor.direccion);
                $('#edit_email').val(vendedor.email);
                $('#edit_genero').val(vendedor.genero);
                // Mostrar el modal
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Hubo un error al obtener los detalles del vendedor');
            }
        });
    }

    function saveEdit() {
        let formData = $('#editForm').serialize();

        $.ajax({
            url: 'operaciones_vendedor/editar_vendedor.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Asumir que la respuesta es JSON y contiene un campo "success"
                let result = JSON.parse(response);
                if (result.success) {
                    alert('vendedor actualizado exitosamente');
                    // Cerrar el modal
                    $('#editModal').modal('hide');
                    // Recargar la página
                    location.reload();
                } else {
                    alert('Hubo un error al actualizar el vendedor');
                }
            },
            error: function() {
                alert('Hubo un error al actualizar el vendedor');
            }
        });
    }

    //Borrar vendedor
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

<?php include('vistas/parte_inferior.php'); ?>