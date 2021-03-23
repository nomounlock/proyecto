<?php include_once "functions/sesiones.php"; ?>

<?php include_once "includes/head.php"; ?>

<body>
    <?php include_once "includes/nav.php"; ?>

    <div class="container-fluid d-flex justify-content-center mt-3">
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Iniciar sesión</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="functions/usuarioController.php">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="email" class="form-label">Correo electrónico</label>

                                    <?php
                                        if(isset($_GET['error']) && $_GET['error'] == 'correo') {

                                            echo '<input type="email" class="form-control border border-danger" id="email" name="email">';

                                            echo '<div class="bg-danger text-white mt-2 p-2">El correo electrónico no está registrado</div>';
                                        } else {

                                            echo '<input type="email" class="form-control" id="email" name="email">';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="password" class="form-label">Contraseña</label>

                                    <?php
                                        if(isset($_GET['error']) && $_GET['error'] == 'clave') {

                                            echo '<input type="password" class="form-control border border-danger" id="password" name="clave">';

                                            echo '<div class="bg-danger text-white mt-2 p-2">La contraseña es incorrecta</div>';
                                        } else {

                                            echo '<input type="password" class="form-control" id="password" name="clave">';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="accion" value="login">

                        <button type="submit" class="btn btn-primary d-flex ms-auto">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>