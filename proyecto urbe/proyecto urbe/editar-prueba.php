<?php include_once "functions/sesiones.php"; ?>
<?php medicoAutenticado(); ?>
<?php include_once "functions/pruebas.php"; ?>

<?php include_once "includes/head.php"; ?>

<body style="min-height: 100vh;">
    <?php include_once "includes/nav.php" ?>

    <div class="d-flex">

        <?php
            if(revisarMedico()) {
                include_once "includes/pruebas-aside.php";
            }
        ?>
        
        <div class="d-flex justify-content-center p-4 col">
            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Editar prueba</h4>
                    </div>

                    <?php
                        $prueba = find($_GET['id']);
                    ?>

                    <div class="card-body">
                        <form method="POST" action="functions/pruebaController.php">
                            <div class="mb-3">
                                <label for="nombre-prueba" class="form-label">Nombre</label>

                                <input type="text" name="nombre" class="form-control" id="nombre-prueba" value="<?= $prueba['nombre'] ?>">
                            </div>

                            <input type="hidden" name="id" value="<?= $prueba['id'] ?>">

                            <input type="hidden" name="accion" value="update">

                            <button type="submit" class="btn btn-primary d-flex ms-auto">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>