<?php
include_once  "BD/conexionMYSQLI.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $Nombre = $_POST['nombre'];
    $Direccion = $_POST['direccion'];
    $Contacto = $_POST['contacto'];
    


    if (!empty($Nombre) && !empty($Direccion) && !empty($Contacto)) {
        $consulta = "INSERT INTO proveedor (nombre, direccion, persona_contacto) VALUES ('$Nombre', '$Direccion', '$Contacto')";
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
?>


<?php require_once "vistas/parte_superior.php"?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                <h2 class="m-0 font-weight-bold text-primary text-center">Agregar Proveedor</h1>    

                        <div class="container mt-5">
                            <div class="card .bg-gradient-success" style="max-width: 450px; margin: auto;">
                                <div class="card-header text-center">
                                    <h5 id="exampleModalLabel" class="mb-0 font-weight-bold">Ingrese Proveedor</h5>
                                </div>
                                <form id="formProductos" action="" method="post" class="card-body">
                                    <div class="form-group">
                                        <label for="nombre" class="col-form-label">Nombre de la empresa:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono" class="col-form-label">Dirección:</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-form-label">Persona de contacto:</label>
                                        <input type="text" class="form-control" id="contacto" name="contacto" required>
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

    <!-- Código JavaScript para eliminar el parámetro 'success' -->
    <script>
        const url = new URL(window.location.href);
        url.searchParams.delete("success");
        window.history.replaceState({}, document.title, url);
    </script>

</body>

</html>