<?php
session_start();
if (isset($_SESSION['type_id'])) {
    include_once '../../Vista/layouts/header.php';
    include_once '../../Conexion/consulSQL.php';
    $fecha = date("Y-m-d");;
?>
    <title>Panel</title>
    <?php
    include_once '../../Vista/layouts/nav.php';
    ?>
    <script src="../../Recursos/js/inicio.js"></script>
    <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_user']; ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Notas</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="container">
            <div class="row">
                <?php
                $sqlNotas = "SELECT N.tipo_nota, N.dirigido, N.descripcion_nota, N.imagen, U.nombre_completo FROM notas N JOIN usuario U ON N.id_autor=U.id 
                WHERE '$fecha'BETWEEN N.fecha_ini AND N.fecha_fin AND ((N.dirigido='Sede' AND N.id_sede=" . $_SESSION['id_sede'] . ") OR (N.dirigido='Cargo' AND N.id_cargo=" . $_SESSION['id_cargo'] . ") OR (N.dirigido='Usuario' AND N.id_usuario=" . $_SESSION['id_user'] . ") OR (N.dirigido='Todos'))";

                $resNotas = ejecutarSQL::consultar($sqlNotas);
                if (mysqli_num_rows($resNotas) > 0) {
                    while ($nota = mysqli_fetch_array($resNotas)) {
                ?>
                        <div class="card col-sm-4">
                            <div class="card-header notiHeader">
                                <img class="img-circle elevation-2 float-left mr-2" alt="User Image" src="../../Recursos/img/logo.png" style="width: 25px;">
                                <h3 class="card-title"><?php echo $nota['tipo_nota']; ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                        <i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="centrado" src="../../Recursos/img/<?php echo $nota['tipo_nota']; ?>.png" class="text-center" style="width: 50%;">
                                <?php
                                if ($nota['imagen'] <> "") {
                                ?>
                                    <div>
                                        <img src="../../Recursos/img/notas/<?php echo $nota['imagen']; ?>" style="width: 100%;">
                                    </div>
                                <?php
                                }
                                ?>
                                <div>
                                    <?php echo $nota['descripcion_nota']; ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <b>Atte. </b><?php echo $nota['nombre_completo']; ?>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                <?php
                    }
                }

                ?>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once '../../Vista/layouts/footer.php';
} else {
    header('Location: ../../login.php');
}
?>