<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reportes</title>

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

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sabores & delicias </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - HOME -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                <i class="bi bi-house-door"></i>
                    <span>HOME</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - productos-- Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="bi bi-cake2-fill"></i>
                    <span>Productos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="consultar_productos.php">Consultar productos</a>
                        <a class="collapse-item" href="agregar_producto.php">Agregar producto</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - proveedores-- Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Proveedores</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="consultar_proveedores.php">Consultar proveedores</a>
                        <a class="collapse-item" href="agregar_proveedor.php">Agregar proveedor</a>
                        
                    </div>
                </div>
            </li>

            <!-- Nav Item - Inventario -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Inventario</span></a>
            </li>

            <!-- Nav Item - Empleados -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-fill-lock"></i>
                    <span>Empleados</span></a>
            </li>

            <!-- Nav Item - venta -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-currency-dollar"></i>
                    <span>Venta</span></a>
            </li>
            
             <!-- Nav Item - Cliente -->
             <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-people-fill"></i>
                    <span>Clientes</span></a>
            </li>

            <!-- Nav Item - pedidos -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-cart-plus"></i>
                    <span>Pedidos</span></a>
            </li>

            <!-- Nav Item - tienda -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar3"></i>
                    <span>Tienda</span></a>
            </li>
            <!-- Nav Item - Reportes -->
            <li class="nav-item">
                <a class="nav-link" href="Reportes.php">
                <i class="bi bi-chat-left-dots-fill"></i>
                    <span>Reportes</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/shop.svg" alt="...">
                <p class="text-center mb-2"><strong>Sabores & delicias</strong>, Frescura y sabor en cada empaque</p>
                
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!--<form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>-->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                    

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <!--<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>-->
                        </li>

                    </ul>

                </nav>
                <!-- End of topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="m-0 font-weight-bold text-primary text-center">Reportes</h1>
                    

                    !-- Tabla de Informe General -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>ID Venta</th>
                                            <th>Fecha</th>
                                            <th>Valor Total</th>
                                            <th>Valor Producto</th>
                                            <th>Nombre Empleado</th>
                                            <th>Apellido Empleado</th>
                                            <th>Nombre Cliente</th>
                                            <th>Apellido Cliente</th>
                                            <th>Nombre Producto</th>
                                            <th>Precio Producto</th>
                                            <th>Cantidad Producto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $database = "saboresydelicias";
                                        $conecta = new mysqli($servername, $username, $password, $database);
                    
                                        // Verificar conexión
                                        if ($conecta->connect_error) {
                                            die("Conexión fallida: " . $conecta->connect_error);
                                        }
                    
                                        $sql = "SELECT 
                                                    v.id_venta, 
                                                    v.fecha, 
                                                    v.valor_total, 
                                                    v.valor_productos, 
                                                    e.nombre AS nombre_empleado, 
                                                    e.apellido AS apellido_empleado, 
                                                    c.nombre AS nombre_cliente, 
                                                    c.apellido AS apellido_cliente, 
                                                    p.nombre AS nombre_producto, 
                                                    p.precio_venta AS precio_producto, 
                                                    pe.cantidad AS cantidad_producto
                                                FROM 
                                                    venta v
                                                JOIN 
                                                    empleado e ON v.empleado_id_empleado = e.id_empleado
                                                JOIN 
                                                    pedido pe ON v.pedido_id_pedido = pe.id_pedido
                                                JOIN 
                                                    cliente c ON pe.cliente_id_cliente = c.id_cliente
                                                JOIN 
                                                    producto p ON pe.producto_id_producto = p.id_producto";
                    
                                        $result = $conecta->query($sql);
                    
                                        if ($result->num_rows > 0) {
                                            // Mostrar datos de cada fila
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>" . $row["id_venta"] . "</td>
                                                        <td>" . $row["fecha"] . "</td>
                                                        <td>" . $row["valor_total"] . "</td>
                                                        <td>" . $row["valor_productos"] . "</td>
                                                        <td>" . $row["nombre_empleado"] . "</td>
                                                        <td>" . $row["apellido_empleado"] . "</td>
                                                        <td>" . $row["nombre_cliente"] . "</td>
                                                        <td>" . $row["apellido_cliente"] . "</td>
                                                        <td>" . $row["nombre_producto"] . "</td>
                                                        <td>" . $row["precio_producto"] . "</td>
                                                        <td>" . $row["cantidad_producto"] . "</td>
                                                      </tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->
            </div>
<!-- Ganancias por Categoría de Producto -->
<div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="font-weight-bold text-center">Ganancias por Categoría de Producto</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Ganancia por Categoría</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_ganancia_categoria = "SELECT 
                                                        p.categoria, 
                                                        SUM(pe.cantidad * p.precio_venta) AS ganancia_por_categoria
                                                    FROM 
                                                        pedido pe
                                                    JOIN 
                                                        producto p ON pe.producto_id_producto = p.id_producto
                                                    GROUP BY 
                                                        p.categoria";

                            $result_ganancia_categoria = $conecta->query($sql_ganancia_categoria);

                            if ($result_ganancia_categoria->num_rows > 0) {
                                // Mostrar datos de cada fila
                                while ($row_categoria = $result_ganancia_categoria->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row_categoria["categoria"] . "</td>
                                            <td>" . $row_categoria["ganancia_por_categoria"] . "</td>
                                          </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div class="container-fluid">

       
        
        <!-- Ganancias Generales -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="font-weight-bold text-center">Ganancias Generales</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Ganancias Generales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "saboresydelicias";
                            $conecta = new mysqli($servername, $username, $password, $database);

                            // Verificar conexión
                            if ($conecta->connect_error) {
                                die("Conexión fallida: " . $conecta->connect_error);
                            }

                            $sql_ganancias = "SELECT 
                                                SUM((producto.precio_venta - producto.precio_compra) * pedido.cantidad) AS ganancias_generales
                                              FROM 
                                                venta
                                              JOIN 
                                                pedido ON venta.pedido_id_pedido = pedido.id_pedido
                                              JOIN 
                                                producto ON pedido.producto_id_producto = producto.id_producto";

                            $result_ganancias = $conecta->query($sql_ganancias);
                            $ganancias_generales = 0;

                            if ($result_ganancias->num_rows > 0) {
                                while ($row_ganancias = $result_ganancias->fetch_assoc()) {
                                    $ganancias_generales = $row_ganancias["ganancias_generales"];
                                }
                            }

                            echo "<tr><td>" . $ganancias_generales . "</td></tr>";
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sabores & delicias 2024</span>
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