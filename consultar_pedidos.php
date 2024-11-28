<?php
include_once "BD/actualizar.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT DISTINCT pedido.id_pedido, pedido.estado, pedido.fecha, producto.id_producto ,cliente.id_cliente, cliente.nombre
                FROM pedido
                LEFT JOIN cliente ON pedido.cliente_id_cliente = cliente.id_cliente
                LEFT JOIN producto ON pedido.producto_id_producto = producto.id_producto;";
                
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

    <title>Consultar Productos</title>

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

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</head>

<body id="page-top">

<?php include('vistas/parte_superior.php'); ?>

                <!-- End of topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Consultar pedido</h1>


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
                                                <th>Numero de Pedido</th>
                                                <th>Estado de pedido</th>
                                                <th>Fecha de Pedido</th>
                                                <th>Id cliente</th>
                                                <th>Cliente</th>
                                                <th>Entregar</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>Numero de Pedido</th>
                                                <th>Estado de pedido</th>
                                                <th>Fecha de Pedido</th>
                                                <th>Id cliente</th>
                                                <th>Cliente</th>
                                                <th>Entregar</th>

                                            </tr>
                                        </tfoot>

                                        <?php
                                        $id = 0; // Inicializa $id fuera del bucle
                                        
                                        foreach ($data as $dat) {
                                            echo "<tr class='text-center'>";
                                            echo "<td>" . $dat['id_pedido'] . "</td>";
                                            echo "<td>" . $dat['estado'] . "</td>";
                                            echo "<td>" . $dat['fecha'] . "</td>";

                                            echo "<td>" . $dat['id_cliente'] . "</td>";
                                            echo "<td>" . $dat['nombre'] . "</td>";
                                            echo "<td>
        <div class='text-center'>
            <div class='btn-group'>
                <form method='get'>
                    <input type='hidden' name='fecha' value='" . $dat['fecha'] . "' />
                    <input type='hidden' name='nom' value='" . $dat['nombre'] . "' />
                    <input type='hidden' name='id_pedido' value='" . $dat['id_pedido'] . "' />
                    <input type='hidden' name='id_cliente' value='" . $dat['id_cliente'] . "' />
                    <input type='hidden' name='id_producto' value='" . $dat['id_producto'] . "' />

                    <button name='agregar' type='submit' class='btn btn-primary'><span class='text'>Elegir</span></button>

                </div>
                    </form>
            </div>
        </div>
        
    </td>";

                                            echo "</tr>";
                                        }
                                        echo "<a class='btn btn-primary' href='#' data-toggle='modal' data-target='#logoutModal'>
                                        <span>Entregar pedido</span>
                                        </a>
                                        <br>";
                                        $id = 0;
                                        if (isset($_GET['agregar'])) {
                                            $fecha = $_GET['fecha'];
                                            $id = $_GET['id_pedido'];
                                            $id_cliente = $_GET['id_cliente'];
                                            $nombre = $_GET['nom'];

                                            echo "A elegido el pedido: ";
                                            echo $id;

                                            // Código para actualizar la base de datos
                                        


                                            if ($resultado) {
                                                $response = array('success' => true, 'message' => 'Actualización exitosa');
                                            } else {
                                                $response = array('success' => false, 'message' => 'Error en la actualización');
                                            }

                                            // Devolver la respuesta en formato JSON
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
            <div id="miSubventana" class="subventana">
                <span class="cerrar" onclick="cerrarVentana()">x</spa>

            </div>
            <script>
                document.getElementById("mostrarVentana").addEventListener("click", function () {
                    document.getElementById("miSubventana").style.display = "block";
                });

                function cerrarVentana() {
                    document.getElementById("miSubventana").style.display = "none";
                }

            </script>
            </tbody>
            </table>
        </div>

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
        function actualizarPagina() {
            location.reload(); // Recargar la página
        }
    </script>


    <!-- Script de jQuery -->
    <script>
        $(document).ready(function () {
            $('#showModalBtn').click(function () {
                $('#logoutModal').modal('show');
            });
        });
    </script>

    <!-- Contenido de la subventana modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="my-order">
                    <div class="my-order-container">
                        <div class="my-order-content">
                            <div class="order">
                                <p>
                                    <?php echo "<span>" . 'fecha : ' . "</span>";
                                    echo "<span>" . $fecha . "</span>";
                                    echo "<br>";

                                    ?>
                                    <?php echo "<span>" . 'Id : ' . "</span>";
                                    echo "<span>" . $id . "</span>";
                                    echo "<br>";

                                    ?>
                                    <?php echo "<span>" . 'Nombre : ' . "</span>";
                                    echo "<span>" . $nombre . "</span>";
                                    echo "<br>";

                                    ?>
                                    <?php
                                    $consul = "SELECT 
                pedido.cantidad, 
                producto.img, 
                producto.nombre, 
                cliente.id_cliente,
                pedido.producto_id_producto
            FROM 
                pedido
            LEFT JOIN 
                cliente 
            ON 
                pedido.cliente_id_cliente = cliente.id_cliente 
            LEFT JOIN 
                producto 
            ON 
                pedido.producto_id_producto = producto.id_producto
            WHERE 
                pedido.id_pedido = '$id';  -- Cambia esta fecha a la que necesites
        ";

                                    $resul = $conexion->prepare($consul);
                                    $resul->execute();
                                    $info = $resul->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                </p>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Entregar</th>

                                        </tr>
                                    </thead>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Entregar</th>

                                        </tr>
                                    </tfoot>

                                    <?php
                                    
                                    
                                    foreach ($info as $in) {
                                        echo "<tr class='text-center'>";
                                        echo "<td>" . $in['cantidad'] . "</td>";
                                        echo "<td><img width='70' src='" . $in['img'] . "'></td>";
                                        echo "<td>" . $in['nombre'] . "</td>";

                                        echo "<td>
        <div class='text-center'>
            <div class='btn-group'>
                <form method='get'>
                    <input type='hidden' name='id_producto' value='" . $in['producto_id_producto'] . "' />

                    <input type='hidden' name='cantidad' value='" . $in['cantidad'] . "' />
                    <button name='agrega' type='submit' class='btn btn-primary'><span class='text'>Elegir</span></button>
                    
                </div>
                    </form>";
                                        if (isset($_GET['agrega'])) {
                                            $cant = $_GET['cantidad'];
                                            $id_producto = $_GET['id_producto'];
                                            echo $id_producto;

                                            // Ejemplo de actualización UPDATE `saboresydelicias`.`inventario` SET `cantidad` = '1' WHERE (`id_inventario` = '1');
                                    
                                            $consulta = "UPDATE inventario SET cantidad = cantidad - '$cant' WHERE producto_id_producto = $id_producto;";
                                            $resultado = conexion::Actualizar($consulta);


                                            //UPDATE `saboresydelicias`.`pedido` SET `estado` = '2' WHERE (`id_pedido` = '50001');
                                            //UPDATE `saboresydelicias`.`pedido` SET `estado` = '1' WHERE (`id_pedido` = '50001');
                                            
                                            $cons = "UPDATE pedido SET estado = '2' WHERE `id_pedido` = '$id' ;";
                                            
                                            $result = conexion::Actualizar($cons);
                                            if ($resultado) {
                                                echo "rl pedido se ha entregado";
                                                $num = 0;
                                            } else {
                                                echo "Error en la actualización";
                                            }
                                        }
                                        echo "</div>
        </div>
        
    </td>";

                                        echo "</tr>";
                                    }


                                    ?>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <?php include('vistas/parte_inferior.php'); ?>
</body>

</html>