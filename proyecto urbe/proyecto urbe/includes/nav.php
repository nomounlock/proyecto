<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-primary" href="index.php">Consultorio médico</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 w-100">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Exámenes
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="ver-examenes.php">Ver exámenes</a></li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item" href="agregar-examen.php">Solicitar examen</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown nav_spacing me-5 pe-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menú
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(!revisarUsuario()) : ?>

                            <li><a class="dropdown-item" href="login.php">Iniciar sesión</a></li>

                            <li><a class="dropdown-item" href="register.php">Registro</a></li>
                        <?php endif; ?>

                        <?php if(revisarMedico()) : ?>

                            <li><a class="dropdown-item" href="#">Usuarios</a></li>
                            
                            <li><hr class="dropdown-divider"></li>
                        <?php endif; ?>
                    
                        <?php if(revisarUsuario()) : ?>
                        
                            <li><a class="dropdown-item" href="index.php?cerrar_sesion=true">Cerrar sesión</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>