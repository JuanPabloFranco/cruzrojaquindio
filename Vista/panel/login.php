<?php
session_start();
if (!empty($_SESSION['type_id'])) {
    header('location: Controlador/loginControler.php');
} else {
    session_destroy();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="shortcut icon" type="image/x-icon" href="Recursos/img/logo.ico" />
        <script src="Recursos/js/jquery.min.js"></script>
        <script src="Recursos/js/bootstrap.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="Recursos/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="Recursos/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <script src="Recursos/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="Recursos/js/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="Recursos/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="Recursos/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="Recursos/js/demo.js"></script>

        <link rel="stylesheet" type="text/css" href="Recursos/css/style_login.css">
        <link rel="stylesheet" type="text/css" href="Recursos/css/all.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <!-- jQuery -->
    </head>

    <body>
        <!-- <img class="wave" src="Recursos/img/hero-bg.png" alt=""> -->
        <div class="contenedor">
            <!-- <div class="img">
                <img src="Recursos/img/logo.png" alt="">
            </div> -->
            <div class="contenido-login">
                <form action="Controlador/loginControler.php" method="post">
                    <img src="Recursos/img/logo.png" alt="">
                    <div class="input-div dni">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Usuario</h5>
                            <input type="text" class="input" name="user" required>
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Contraseña</h5>
                            <input type="password" class="input" name="pass" required>
                        </div>
                    </div>
                    <p class="h6"><?php if(isset($_GET['msj'])){echo $_GET['msj'];}?></p>
                    <input type="submit" class="btn" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </body>
    <script src="Recursos/js/login.js"></script>
<?php
}
?>
</html>