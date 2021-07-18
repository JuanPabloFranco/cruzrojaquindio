<header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
  <div class="container d-flex align-items-center">

    <div class="logo mr-auto">
      <a href="index.html"><img src="Recursos/img/logo.png" alt="" class="img-fluid"></a>
    </div>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="index.php">Inicio</a></li>
        <li><a href="#portfolio">Galeria</a></li>
        <li><a href="#services">Servicios</a></li>
        <li><a href="#pricing">Precios</a></li>
        <li><a href="#contact">Contáctanos</a></li>
        <?php
        if (isset($_SESSION['type_user'])) {
        ?>
          <li><a href="Vista/adm_panel.php">Entrar</a></li>
        <?php
        } else {
        ?>
          <li><a href="login.php">Login</a></li>
        <?php
        }
        ?>
        <li class="drop-down"><a href="">Más</a>
          <ul>
            <li><a href="#about">Conócenos</a></li>
            <li><a href="#">Reservas</a></li>
            <li><a href="#team">Eventos</a></li>
            <li><a href="#testimonials">Testimonios</a></li>
            <!-- <li class="drop-down"><a href="#">Drop Down 2</a>
              <ul>
                <li><a href="#">Deep Drop Down 1</a></li>
              </ul>
            </li> -->
          </ul>
        </li>
      </ul>
    </nav><!-- .nav-menu -->

  </div>
</header><!-- End Header -->