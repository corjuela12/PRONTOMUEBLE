<?php
include_once  "BD/conexionMYSQLI.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $Idproducto = $_POST['id_producto'];
    $Nombre = $_POST['nombre'];
    $Marca= $_POST['marca'];
    $Preciocompra = $_POST['precio_compra'];
    $Imagen = $_POST['img'];
    $Precioventa = $_POST['precio_venta'];
    $Categoria = $_POST['categoria'];
    $Descripcion = $_POST['descripcion'];


    if (!empty($Idproducto) && !empty($Nombre) && !empty($Marca) && !empty($Preciocompra) && !empty($Imagen)&& !empty($Precioventa)&& !empty($Categoria)&& !empty($Descripcion) ) {
       
        $consulta = "INSERT INTO producto (id_producto, nombre, marca, precio_compra, img, precio_venta, categoria, descripcion) 
        VALUES ('$Idproducto', '$Nombre', '$Marca', '$Preciocompra', '$Imagen', '$Precioventa', '$Categoria', '$Descripcion')";
        
        if ($enlace->query($consulta) === TRUE) {
            $mensaje = "Producto insertado correctamente";
        } else {
            $mensaje = "Error al insertar proveedor: " . $enlace->error;
        }
    }

}
?>
<?php require_once "vistas/parte_superior.php"?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Agregar Producto</h1>
                    

                        <div class="container mt-5">
                            <div class="card .bg-gradient-success" style="max-width: 450px; margin: auto;">
                                <div class="card-header  text-center">
                                    <h5 id="exampleModalLabel" class="mb-0 font-weight-bold">Ingrese Producto</h5>
                                </div>
                                <form id="formProductos" action="" method="post" class="card-body">
                                    <div class="form-group">
                                        <label for="id_producto" class="col-form-label">Id producto:</label>
                                        <input type="number" class="form-control" id="id_producto" name="id_producto" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre" class="col-form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="marca" class="col-form-label">Marca:</label>
                                        <input type="text" class="form-control" id="marca" name="marca" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio_compra" class="col-form-label">Precio de compra:</label>
                                        <input type="number" class="form-control" id="precio_compra" name="precio_compra" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="img" class="col-form-label">Imagen:</label>
                                        <input type="text" class="form-control" id="img" name="img" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio_venta" class="col-form-label">Precio de venta:</label>
                                        <input type="number" class="form-control" id="precio_venta" name="precio_venta" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoria" class="col-form-label">Categoria:</label>
                                        <input type="text" class="form-control" id="categoria" name="categoria" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion" class="col-form-label">Descripcion:</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
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
                        <span>Copyright &copy; ProntoMueble 2024</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

</body>

</html>