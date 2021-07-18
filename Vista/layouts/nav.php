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
                        <a href="../../Vista/adm_panel.php" class="nav-link">Inicio</a>
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
                <a href="../../Vista/adm_panel.php" class="brand-link">
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
                                            <a href="../../Vista/editar_datos_personales.php?modulo=inf1" class="nav-link <?php echo $_GET['modulo'] == 'inf1' ? 'active' : '' ?>">
                                                <i class="fas fa-user-tag nav-icon"></i>
                                                <p>Información personal</p>
                                            </a>
                                        </li>
                                        <?php
                                        if ($_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_usuario.php?modulo=inf2" class="nav-link <?php echo $_GET['modulo'] == 'inf2' ? 'active' : '' ?>">
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
                                <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'sedes' || $_GET['modulo'] == 'cargos' || $_GET['modulo'] == 'servicios' || $_GET['modulo'] == 'sede' || $_GET['modulo'] == 'galeria' || $_GET['modulo'] == 'esal' || $_GET['modulo'] == 'noticia' || $_GET['modulo'] == 'evento' || $_GET['modulo'] == 'configuracion' ? 'menu-open' : 'menu-close' ?>">
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
                                                <a href="../../Vista/configuracion.php?modulo=configuracion" class="nav-link <?= $_GET['modulo'] == 'configuracion' ? 'active' : '' ?>">
                                                    <i class="fas fa-cog nav-icon"></i>
                                                    <p>Configurar Sistema</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_cargos.php?modulo=cargos" class="nav-link <?= $_GET['modulo'] == 'cargos' ? 'active' : '' ?>">
                                                    <i class="fas fa-sitemap nav-icon"></i>
                                                    <p>Gestión Cargos</p>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        if ($_SESSION['permisos'][0]->sedes == 'Activo' || $_SESSION['type_id'] <= 2) {
                                            if ($_SESSION['permisos'][0]->cobertura == 'Full') {
                                            ?>
                                                <li class="nav-item">
                                                    <a href="../../Vista/adm_sedes.php?modulo=sedes" class="nav-link <?= $_GET['modulo'] == 'sedes' ? 'active' : '' ?>">
                                                        <i class="fas fa-map-marker-alt nav-icon"></i>
                                                        <p>Gestión Sedes</p>
                                                    </a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="nav-item">
                                                    <a href="../../Vista/adm_sede.php?modulo=sede" class="nav-link <?= $_GET['modulo'] == 'sede' ? 'active' : '' ?>">
                                                        <i class="fas fa-map-marker-alt nav-icon"></i>
                                                        <p>Gestión Sede</p>
                                                    </a>
                                                </li>
                                            <?php
                                            }
                                        }
                                        if ($_SESSION['permisos'][0]->servicios == 'Activo' || $_SESSION['type_id'] <= 2) {
                                            ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_servicios.php?modulo=servicios" class="nav-link <?= $_GET['modulo'] == 'servicios' ? 'active' : '' ?>">
                                                    <i class="fas fa-bell nav-icon"></i>
                                                    <p>Gestión Servicios</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['permisos'][0]->galeria == 'Activo' || $_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_galeria.php?modulo=galeria" class="nav-link <?= $_GET['modulo'] == 'galeria' ? 'active' : '' ?>">
                                                    <i class="fas fa-images nav-icon"></i>
                                                    <p>Gestión Galeria Imágenes</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['permisos'][0]->esal == 'Activo' || $_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_esal.php?modulo=esal" class="nav-link <?= $_GET['modulo'] == 'esal' ? 'active' : '' ?>">
                                                    <i class="fas fa-folder-open nav-icon"></i>
                                                    <p>Gestión ESAL</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['permisos'][0]->noticias == 'Activo' || $_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_noticias.php?modulo=noticia" class="nav-link <?= $_GET['modulo'] == 'noticia' ? 'active' : '' ?>">
                                                    <i class="fas fa-newspaper nav-icon"></i>
                                                    <p>Gestión Noticias</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['permisos'][0]->eventos == 'Activo' || $_SESSION['type_id'] <= 2) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_eventos.php?modulo=evento" class="nav-link <?= $_GET['modulo'] == 'evento' ? 'active' : '' ?>">
                                                    <i class="fas fa-calendar-alt nav-icon"></i>
                                                    <p>Gestión Eventos</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
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
                                                <a href="../../Vista/adm_visitantes.php?modulo=visitantes" class="nav-link <?= $_GET['modulo'] == 'visitantes' ? 'active' : '' ?>">
                                                    <i class="fas fa-people-arrows nav-icon"></i>
                                                    <p>Gestión Visitantes</p>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->usuarios == 'Activo') {
                                        ?>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_usuarios.php?modulo=usuarios" class="nav-link <?= $_GET['modulo'] == 'usuarios' ? 'active' : '' ?>">
                                                    <i class="fas fa-hands-helping nav-icon"></i>
                                                    <p>Gestión Usuarios</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../../Vista/adm_reportes.php?modulo=reportes" class="nav-link <?= $_GET['modulo'] == 'reportes' ? 'active' : '' ?>">
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
                            <li class="nav-header">Hda Golondrinas</li>
                            <li class="nav-item has-treeview <?php echo $_GET['modulo'] == 'visitas' || $_GET['modulo'] == 'reportes_visit' ? 'menu-open' : 'menu-close' ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-map-marked-alt"></i>
                                    <p>
                                        Visitas
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    if ($_SESSION['type_id'] <= 2 || $_SESSION['permisos'][0]->usuarios == 'Activo') {
                                    ?>
                                        <li class="nav-item">
                                            <a href="../../Vista/adm_visitas.php?modulo=visitas" class="nav-link <?= $_GET['modulo'] == 'visitas' ? 'active' : '' ?>">
                                                <i class="fas fa-map-marker-alt nav-icon"></i>
                                                <p>Gestión Visitas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../../Vista/adm_reportes_visitas.php?modulo=reportes_visit" class="nav-link <?= $_GET['modulo'] == 'reportes_visit' ? 'active' : '' ?>">
                                                <i class="fas fa-file-alt nav-icon"></i>
                                                <p>Reportes Visitas</p>
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
                                            <a href="../../Vista/adm_reservas.php?modulo=reservas" class="nav-link <?= $_GET['modulo'] == 'reservas' ? 'active' : '' ?>">
                                                <i class="fas fa-campground nav-icon"></i>
                                                <p>Gestión Reservas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../../Vista/adm_reportes_reservas.php?modulo=reportes_reservas" class="nav-link <?= $_GET['modulo'] == 'reportes_reservas' ? 'active' : '' ?>">
                                                <i class="fas fa-file-alt nav-icon"></i>
                                                <p>Reportes Reservas</p>
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
                                    <a href="../../Vista/adm_msj.php?modulo=msj" class="nav-link <?= $_GET['modulo'] == 'msj' ? 'active' : '' ?>">
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
                                    <a href="../../Vista/adm_contactos.php?modulo=agenda" class="nav-link <?= $_GET['modulo'] == 'agenda' ? 'active' : '' ?>">
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
                                    <a href="../../Vista/adm_notas.php?modulo=notas" class="nav-link <?= $_GET['modulo'] == 'notas' ? 'active' : '' ?>">
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
                                    <a href="../../Vista/mis_opiniones.php?modulo=mis_opiniones" class="nav-link <?= $_GET['modulo'] == 'mis_opiniones' ? 'active' : '' ?>">
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
                                    <a href="../../Vista/promociones.php?modulo=promociones" class="nav-link <?= $_GET['modulo'] == 'promociones' ? 'active' : '' ?>">
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
                                    <a href="../../Vista/mis_fotos.php?modulo=mis_fotos" class="nav-link <?= $_GET['modulo'] == 'mis_fotos' ? 'active' : '' ?>">
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