<?php
include_once "BD/actualizar.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT producto.id_producto, producto.nombre, producto.img, inventario.cantidad  
                FROM producto 
                LEFT JOIN inventario 
                ON producto.id_producto = inventario.producto_id_producto";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Consultar Inventario</title>

    <!-- Custom fonts for this template -->
    <link href="icons/font/bootstrap-icons.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php include('vistas/parte_superior.php'); ?>

                <!-- End of topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Consultar Inventario</h1>


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
                                                <th>Imagen</th>
                                                <th>Cantidad</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>Id producto</th>
                                                <th>Nombre</th>
                                                <th>Imagen</th>
                                                <th>Cantidad</th>
                                                <th>Agregar inventario</th>
                                            </tr>
                                        </tfoot>

                                        <?php
                                        foreach ($data as $dat) {
                                            echo "<tr class='text-center'>";
                                            echo "<td>" . $dat['id_producto'] . "</td>";
                                            echo "<td>" . $dat['nombre'] . "</td>";
                                            echo "<td><img width='70' src='" . $dat['img'] . "'></td>";
                                            echo "<td>" . $dat['cantidad'] . "</td>";
                                            echo "<td>
            <div class='text-center'>
                <div class='btn-group'>
                    <form method='get'>
                        <input name='num' type='number' min='0' style='width: 50px; margin-right: 5px;' placeholder='10' required />
                        <input type='hidden' name='id_producto' value='" . $dat['id_producto'] . "' />
                        <button name='agregar' type='submit' class='btn btn-primary'><span class='text'>Agregar</span></button>
                    </form>
                </div>
            </div>
          </td>";
                                            echo "</tr>";
                                        }

                                        if (isset($_GET['agregar'])) {
                                            $id = $_GET['id_producto'];
                                            $num = $_GET['num'];

                                            // Ejemplo de actualización UPDATE `saboresydelicias`.`inventario` SET `cantidad` = '1' WHERE (`id_inventario` = '1');
                                        
                                            $consulta = "UPDATE inventario SET cantidad = cantidad + '$num' WHERE producto_id_producto = '$id'";
                                            $resultado = conexion::Actualizar($consulta);

                                            if ($resultado) {
                                                echo "Actualización exitosa";
                                                $num = 0;
                                            } else {
                                                echo "Error en la actualización";
                                            }
                                        }
                                        ?>



                                    </table>
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            </tbody>
            </table>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const showModalBtns = document.querySelectorAll('.showModalBtn');

                showModalBtns.forEach(btn => {
                    btn.addEventListener('click', function () {
                        const idProducto = this.getAttribute('data-id');

                        // Aquí realizas la solicitud AJAX al archivo PHP que manejará la petición
                        // Puedes usar la función fetch() o XMLHttpRequest para enviar la solicitud
                    });
                });
            });

        </script>
        <!-- Footer -->
        
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
    <div id="subventana">
        <!-- Aquí se cargará el contenido de la subventana -->
    </div>
    <?php include('vistas/parte_inferior.php'); ?>
</body>

</html>