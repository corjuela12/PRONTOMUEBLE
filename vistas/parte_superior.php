
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ProntoMueble</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="icons/font/bootstrap-icons.min.css" rel="stylesheet" type="text/css">
    
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="img/chair.png" alt="..." style="width: 40px; height: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">PRONTOMUEBLE </div>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventario"
                    aria-expanded="true" aria-controls="collapseInventario">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Inventario</span>
                </a>
                <div id="collapseInventario" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="consultar_inventario.php">Consultar Inventario</a>
                        
                        
                    </div>
                </div>
            </li>

            <!-- Nav Item - Empleados -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse-empleado">
                    <i class="bi bi-person-fill-lock"></i>
                    <span>Empleados</span>
                </a>
                <div id="collapse-empleado" class="collapse" aria-labelledby="heading-empleado" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="crear_empleado.php">Agregar Empleado</a>
                            <a class="collapse-item" href="consultar_empleado.php">Consultar Empleado</a>
                            <a class="collapse-item" href="editar_empleado.php">Editar Empleado</a>
                        </div>
                    </div>
            </li>

            <!-- Nav Item - venta -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-currency-dollar"></i>
                    <span>Venta</span></a>
            </li>
            
             <!-- Nav Item - Cliente -->
             <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes"
        aria-expanded="true" aria-controls="collapseClientes">
        <i class="bi bi-people-fill"></i>
        <span>Clientes</span>
    </a>
    <div id="collapseClientes" class="collapse" aria-labelledby="headingClientes" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="agregar_cliente.php">Agregar Cliente</a>
        <a class="collapse-item" href="consultar_clientes.php">Consultar Clientes</a>
        <a class="collapse-item" href="informe_consumos.php">Informe de Consumos</a>
    </div>
</div>
</li>

            <!-- Nav Item - pedidos -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePedido"
                    aria-expanded="true" aria-controls="collapsePedido">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Pedidos</span>
                </a>
                <div id="collapsePedido" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="consultar_pedidos.php">Consultar Pedidos</a>
                        
                        
                    </div>
                </div>
            </li>
           

            <!-- Nav Item - tienda -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-tienda">
                    <i class="bi bi-calendar3"></i> <!--Icono del calendario al lado de la palabra tienda-->
                    <span>Tienda</span>
                </a>
                    <div id="collapse-tienda" class="collapse" aria-labelledby="heading-tienda" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="crear_tienda.php">Agregar Tienda</a>
                            <a class="collapse-item" href="consultar_tienda.php">Consultar Tienda</a>
                            <a class="collapse-item" href="editar_tienda.php">Editar Tienda</a>
                        </div>
                    </div>
            </li>

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
                <img class="sidebar-card-illustration mb-2" src="img/chair.png" alt="...">
                <p class="text-center mb-2"><strong>PRONTOMUEBLE</strong>, Diseño y comodidad para cada rincón de tu hogar</p>
                
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
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuracion
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->



