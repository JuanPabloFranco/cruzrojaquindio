<?php
session_start();
    include_once '../..Vista/layouts/header.php'
?>
    <title>Error 404</title>
    <?php
    include_once '../..Vista/layouts/nav.php';
    ?>
    <!-- Modal -->
    <script src="../..Recursos/js/cargos.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <input type="hidden" id="txtTipoUsuario" value="<?php echo $_SESSION['type_id']; ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-">
                    <div class="col-sm-12 text-center">
                        <img src="../..Recursos/img/logo.png" alt="">
                        <h1>ERROR 404</h1>
                        <br>
                        <h6>Lo siento, no tienes permiso para acceder a esta pagina</h6>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>  
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once '../..Vista/layouts/footer.php';
?>