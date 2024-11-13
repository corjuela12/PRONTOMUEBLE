<?php
include_once  "BD/conexionPDO.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_producto, nombre, marca, precio_compra, img, precio_venta,categoria, descripcion FROM producto";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

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
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!--<h6 class="collapse-header">Custom Components:</h6>-->
                        <a class="collapse-item" href="">Crear tienda</a>
                        <a class="collapse-item" href="">Consultar Tienda</a>
                        <a class="collapse-item" href="">Modificar Tienda</a>
                    </div>
                </div>
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
            url: 'obtener_producto.php',
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
            url: 'editar_producto.php',
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
        url: 'borrar_producto.php',
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