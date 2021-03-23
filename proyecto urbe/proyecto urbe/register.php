<?php include_once "functions/sesiones.php"; ?>

<?php include_once "includes/head.php"; ?>

<body>
    <?php include_once "includes/nav.php"; ?>

    <div class="container-fluid d-flex justify-content-center mt-3">
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Registro de usuario</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="functions/usuarioController.php">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="email" class="form-label">Correo electrónico</label>

                                    <input type="email" class="form-control" id="email" name="email">
                                </div>

                                <div class="col">
                                    <label for="nombre" class="form-label">Nombre</label>

                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="password" class="form-label">Contraseña</label>

                                    <input type="password" class="form-control" id="password" name="clave">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="altura" class="form-label">Altura (cm)</label>

                                    <input type="number" class="form-control" id="altura" name="altura">
                                </div>

                                <div class="col">
                                    <label for="peso" class="form-label">Peso (kg)</label>

                                    <input type="number" step="0.01" class="form-control" id="peso" name="peso">
                                </div>

                                <div class="col">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>

                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="accion" value="store">

                        <button type="submit" class="btn btn-primary d-flex ms-auto">Registrarme</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>