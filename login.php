<?php
include_once "BD/conexionMYSQLI.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = md5($_POST['contrasena']); // Generar hash MD5 de la contraseña ingresada

    if (!empty($correo) && !empty($contrasena)) {
        $consulta = "SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?";
        $stmt = $enlace->prepare($consulta);
        $stmt->bind_param("ss", $correo, $contrasena);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            header("Location: inicio.php");
            exit();
        } else {
            $mensaje = "Correo o contraseña incorrectos.";
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/sb-admin-2.min.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <!-- Imagen del logo -->
                            <div class="col-lg-6 d-flex justify-content-center align-items-center cen">
                                <img src="img/logo.png" class="ima">
                            </div>
                            <!-- Formulario de login -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">BIENVENIDO</h1>
                                    </div>
                                    <form action="login.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="correo" class="form-control form-control-user" placeholder="Ingresa correo electrónico..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="contrasena" class="form-control form-control-user" placeholder="Contraseña" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recordarme</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Entra con Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Entra con Facebook
                                        </a>
                                    </form>
                                    <?php if (!empty($mensaje)) : ?>
                                        <div class="alert alert-danger mt-3">
                                            <?php echo $mensaje; ?>
                                        </div>
                                    <?php endif; ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Olvidé mi contraseña</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">¡Crear una nueva cuenta!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
