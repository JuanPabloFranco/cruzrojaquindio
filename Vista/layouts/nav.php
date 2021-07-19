    <head>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="../../Recursos/img/cruz_icono.png" />
        <!-- jQuery -->
        <script src="../../Recursos/js/jquery.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../Recursos/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../Recursos/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link href="../../Recursos/fontawesome/css/all.css" rel="stylesheet">

        <!-- Bootstrap 4 -->
        <script src="../../Recursos/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../Recursos/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../Recursos/js/demo.js"></script>
        <!-- Sweet alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- Select 2 -->
        <script src="../../Recursos/js/select2.js"></script>
        <!-- Select 2 -->
        <link rel="stylesheet" href="../../Recursos/css/select2.css">

        <link rel="stylesheet" href="../../Recursos/css/styles.css">
    </head>

    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="../../Vista/panel/adm_panel.php" class="nav-link">Inicio</a>
                    </li>
                    <?php
                    if ($_SESSION['type_id'] <= 3) {
                    ?>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Contacto Soporte
                                <span class="badge badge-warning right" id="spanContacto">0</span></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <a href="../../Controlador/logout.php">Cerrar Sesión</a>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="../../Vista/panel/adm_panel.php" class="brand-link">
                    <img src="../../Recursos/img/cruz_icono.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Panel de sistema</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img id="avatar4" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?php echo $_SESSION['name_user']; ?></a>
                            <a href="#" class="d-block SMALL"><?php echo $_SESSION['type_user']; ?></a>
                            <input type="hidden" value="<?php echo $_SESSION['id_sede']; ?>" id="txtIdSede">
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <?php
                            if ($_SESSION['type_id'] <> 1) {
                            ?>
                                <li class="nav-header">Información Personal</li>
                                <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'inf1' || $_GET['modulo'] == 'inf2' ? 'menu-open' : 'menu-close' ?>">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-user-cog"></i>
                                        <p>
                                            Mi perfil
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../Vista/panel/editar_datos_personales.php?modulo=inf1" class="nav-link <?php echo $_GET['modulo'] == 'inf1' ? 'active' : '' ?>">
                                                <i class="fas fa-user-tag nav-icon"></i>
                                                <p>Información personal</p>
                                            </a>
                                        </li>
                                        <?php
                                        if ($_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_usuario.php?modulo=inf2" class="nav-link <?php echo $_GET['modulo'] == 'inf2' ? 'active' : '' ?>">
                                                    <i class="fas fa-users-cog nav-icon"></i>
                                                    <p>Información Adicional</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            if ((isset($_SESSION['type_id']) && $_SESSION['type_id'] <= 2) || $_SESSION['id_cargo'] <> 1) {
                            ?>
                                <li class="nav-header">Configuración</li>
                                <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'sedes' || $_GET['modulo'] == 'cargos' || $_GET['modulo'] == 'sede' ? 'menu-open' : 'menu-close' ?>">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-cogs"></i>
                                        <p>
                                            Administrar sistema
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <?php
                                        if ($_SESSION['permisos'][0]->adm == 'Activo' || $_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/configuracion.php?modulo=configuracion" class="nav-link <?= $_GET['modulo'] == 'configuracion' ? 'active' : '' ?>">
                                                    <i class="fas fa-cog nav-icon"></i>
                                                    <p>Configurar Sistema</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_cargos.php?modulo=cargos" class="nav-link <?= $_GET['modulo'] == 'cargos' ? 'active' : '' ?>">
                                                    <i class="fas fa-sitemap nav-icon"></i>
                                                    <p>Gestión Cargos</p>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        if ($_SESSION['permisos'][0]->sedes == 'Activo' || $_SESSION['type_id'] <= 2) {
                                            if ($_SESSION['permisos'][0]->cobertura == 'Full' || $_SESSION['type_id'] <= 2) {
                                            ?>
                                                <li class="nav-item">
                                                    <a href="../../Vista/panel/adm_sedes.php?modulo=sedes" class="nav-link <?= $_GET['modulo'] == 'sedes' ? 'active' : '' ?>">
                                                        <i class="fas fa-map-marker-alt nav-icon"></i>
                                                        <p>Gestión Sedes</p>
                                                    </a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="nav-item">
                                                    <a href="../../Vista/panel/adm_sede.php?modulo=sede" class="nav-link <?= $_GET['modulo'] == 'sede' ? 'active' : '' ?>">
                                                        <i class="fas fa-map-marker-alt nav-icon"></i>
                                                        <p>Gestión Sede</p>
                                                    </a>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                                if ($_SESSION['permisos'][0]->servicios == 'Activo' || $_SESSION['type_id'] <= 2) {
                                ?>
                                    <li class="nav-item has-treeview <?php echo  $_GET['modulo'] == 'servicios' ? 'menu-open' : 'menu-close' ?>">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-bell"></i>
                                            <p>
                                                Servicios
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_servicios.php?modulo=servicios" class="nav-link <?= $_GET['modulo'] == 'servicios' ? 'active' : '' ?>">
                                                    <i class="fas fa-bell nav-icon"></i>
                                                    <p>Servicios Cruz Roja</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_servicios.php?modulo=servicios" class="nav-link <?= $_GET['modulo'] == 'servicios' ? 'active' : '' ?>">
                                                    <i class="fas fa-bell nav-icon"></i>
                                                    <p>Servicios Banco de sangre</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_servicios.php?modulo=servicios" class="nav-link <?= $_GET['modulo'] == 'servicios' ? 'active' : '' ?>">
                                                    <i class="fas fa-bell nav-icon"></i>
                                                    <p>Servicios Hotel</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                                <?php
                                if ($_SESSION['permisos'][0]->galeria == 'Activo' || $_SESSION['type_id'] <= 2) {
                                ?>
                                    <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'galeria' ? 'menu-open' : 'menu-close' ?>">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-images"></i>
                                            <p>
                                                Galeria de imágenes
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_galeria.php?modulo=galeria" class="nav-link <?= $_GET['modulo'] == 'galeria' ? 'active' : '' ?>">
                                                    <i class="fas fa-image nav-icon"></i>
                                                    <p>Galeria Cruz Roja</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_galeria.php?modulo=galeria" class="nav-link <?= $_GET['modulo'] == 'galeria' ? 'active' : '' ?>">
                                                    <i class="fas fa-image nav-icon"></i>
                                                    <p>Galeria Banco de sangre</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_galeria.php?modulo=galeria" class="nav-link <?= $_GET['modulo'] == 'galeria' ? 'active' : '' ?>">
                                                    <i class="fas fa-image nav-icon"></i>
                                                    <p>Galeria Hotel</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                                <?php
                                if ($_SESSION['permisos'][0]->esal == 'Activo' || $_SESSION['type_id'] <= 2) {
                                ?>
                                    <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'esal' ? 'menu-open' : 'menu-close' ?>">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-folder"></i>
                                            <p>
                                                Esal
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_esal.php?modulo=esal" class="nav-link <?= $_GET['modulo'] == 'esal' ? 'active' : '' ?>">
                                                    <i class="fas fa-folder-open nav-icon"></i>
                                                    <p>Esal Cruz Roja</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_esal.php?modulo=esal" class="nav-link <?= $_GET['modulo'] == 'esal' ? 'active' : '' ?>">
                                                    <i class="fas fa-folder-open nav-icon"></i>
                                                    <p>Esal Banco de sangre</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_esal.php?modulo=esal" class="nav-link <?= $_GET['modulo'] == 'esal' ? 'active' : '' ?>">
                                                    <i class="fas fa-folder-open nav-icon"></i>
                                                    <p>Esal Hotel</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                                <?php
                                if ($_SESSION['permisos'][0]->noticias == 'Activo' || $_SESSION['type_id'] <= 2) {
                                ?>
                                    <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'noticias'  ? 'menu-open' : 'menu-close' ?>">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-newspaper"></i>
                                            <p>
                                                Noticias
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_noticias.php?modulo=noticias" class="nav-link <?= $_GET['modulo'] == 'noticias' ? 'active' : '' ?>">
                                                    <i class="fas fa-newspaper nav-icon"></i>
                                                    <p>Noticias Cruz Roja</p>
                                                </a>
                                            </li>                                            
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                            <?php
                            }
                            if ($_SESSION['type_id'] <= 2 || ($_SESSION['permisos'][0]->usuarios == 'Activo' || $_SESSION['permisos'][0]->visitantes == 'Activo')) {
                            ?>
                                <li class="nav-header">Talento Humano</li>
                                <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'usuarios' || $_GET['modulo'] == 'reportes' || $_GET['modulo'] == 'visitantes' ? 'menu-open' : 'menu-close' ?>">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Usuarios
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <?php
                                        if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->visitantes == 'Activo') {
                                        ?>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link <?= $_GET['modulo'] == 'donantes' ? 'active' : '' ?>">
                                                    <i class="fas fa-heartbeat nav-icon"></i>
                                                    <p>Gestión Donantes</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->turistas == 'Activo') {
                                            ?>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link <?= $_GET['modulo'] == 'turistas' ? 'active' : '' ?>">
                                                        <i class="fas fa-people-arrows nav-icon"></i>
                                                        <p>Gestión Turistas</p>
                                                    </a>
                                                </li>
                                            <?php
                                            }
                                        if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->usuarios == 'Activo') {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_usuarios.php?modulo=usuarios" class="nav-link <?= $_GET['modulo'] == 'usuarios' ? 'active' : '' ?>">
                                                    <i class="fas fa-user nav-icon"></i>
                                                    <p>Gestión Usuarios</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/panel/adm_reportes.php?modulo=reportes" class="nav-link <?= $_GET['modulo'] == 'reportes' ? 'active' : '' ?>">
                                                    <i class="fas fa-file-alt nav-icon"></i>
                                                    <p>Reportes</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="nav-header">Hotel Tacurrumbi</li>
                            <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'visitas' || $_GET['modulo'] == 'reportes_visit' ? 'menu-open' : 'menu-close' ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>
                                        Habitaciones
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->usuarios == 'Activo') {
                                    ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link <?= $_GET['modulo'] == 'visitas' ? 'active' : '' ?>">
                                                <i class="fas fa-bed nav-icon"></i>
                                                <p>Gestión Habitaciones</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link <?= $_GET['modulo'] == 'reportes_visit' ? 'active' : '' ?>">
                                                <i class="fas fa-file-alt nav-icon"></i>
                                                <p>Reportes habitaciones</p>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'reservas' || $_GET['modulo'] == 'reportes_reservas' ? 'menu-open' : 'menu-close' ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-concierge-bell"></i>
                                    <p>
                                        Reservas
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->usuarios == 'Activo') {
                                    ?>
                                        <li class="nav-item">
                                            <a href="../../Vista/panel/adm_reservas.php?modulo=reservas" class="nav-link <?= $_GET['modulo'] == 'reservas' ? 'active' : '' ?>">
                                                <i class="fas fa-concierge-bell nav-icon"></i>
                                                <p>Gestión Reservas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../../Vista/panel/adm_reportes_reservas.php?modulo=reportes_reservas" class="nav-link <?= $_GET['modulo'] == 'reportes_reservas' ? 'active' : '' ?>">
                                                <i class="fas fa-file-alt nav-icon"></i>
                                                <p>Reportes Reservas</p>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'cupones' || $_GET['modulo'] == 'reportes_cupones' ? 'menu-open' : 'menu-close' ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Cupones
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->usuarios == 'Activo') {
                                    ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link <?= $_GET['modulo'] == 'cupones' ? 'active' : '' ?>">
                                                <i class="fas fa-tag nav-icon"></i>
                                                <p>Gestiónar cupones</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link <?= $_GET['modulo'] == 'reportes_cupones' ? 'active' : '' ?>">
                                                <i class="fas fa-file-alt nav-icon"></i>
                                                <p>Reportes Cupones</p>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>


                            <li class="nav-header">Actividades</li>
                            <?php
                            if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->msj_contacto == 'Activo') {
                            ?>
                                <li class="nav-item">
                                    <a href="../../Vista/panel/adm_msj.php?modulo=msj" class="nav-link <?= $_GET['modulo'] == 'msj' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-envelope"></i>
                                        <p>
                                            Mensajes de contacto <span class="badge badge-info right" id="spanMsj"></span>
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->agenda == 'Activo') {
                            ?>
                                <li class="nav-item">
                                    <a href="../../Vista/panel/adm_contactos.php?modulo=agenda" class="nav-link <?= $_GET['modulo'] == 'agenda' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>
                                            Agenda de Contactos
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->notas == 'Activo') {
                            ?>
                                <li class="nav-item">
                                    <a href="../../Vista/panel/adm_notas.php?modulo=notas" class="nav-link <?= $_GET['modulo'] == 'notas' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-sticky-note"></i>
                                        <p>
                                            Notas de inicio
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($_SESSION['type_id'] >= 3) {
                            ?>
                                <li class="nav-item">
                                    <a href="../../Vista/panel/mis_opiniones.php?modulo=mis_opiniones" class="nav-link <?= $_GET['modulo'] == 'mis_opiniones' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>
                                            Mis opiniones
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($_SESSION['type_id'] >= 3) {
                            ?>
                                <li class="nav-item">
                                    <a href="../../Vista/panel/promociones.php?modulo=promociones" class="nav-link <?= $_GET['modulo'] == 'promociones' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>
                                            Promociones
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($_SESSION['type_id'] >= 3) {
                            ?>
                                <li class="nav-item">
                                    <a href="../../Vista/panel/mis_fotos.php?modulo=mis_fotos" class="nav-link <?= $_GET['modulo'] == 'mis_fotos' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>
                                            Mis fotos
                                        </p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
        </div>
    </body>