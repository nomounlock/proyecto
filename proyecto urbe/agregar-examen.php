<?php include_once "functions/sesiones.php"; ?>
<?php usuarioAutenticado(); ?>
<?php include_once "functions/pruebas.php"; ?>

<?php include_once "includes/head.php"; ?>

<body style="min-height: 100vh;">
    <?php include_once "includes/nav.php" ?>

    <div class="d-flex">

        <?php
            if(revisarMedico()) {
                include_once "includes/examenes-aside.php";
            }
        ?>
        
        <div class="d-flex justify-content-center p-4 col">
            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Solicitar exámen</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="functions/examenController.php">
                            <div class="row">
                                <?php
                                    $pruebas = all();
                                    $i = 0;

                                    foreach ($pruebas as $prueba) :
                                        if ($i % 5 == 0) {
                                            echo '<div class="col">';
                                        }
                                        ?>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="<?= $prueba['id'] ?>" name="pruebas[]" id="prueba<?= $prueba['id'] ?>">

                                            <label class="form-check-label" for="prueba<?= $prueba['id'] ?>"><?= $prueba['nombre'] ?></label>
                                        </div>

                                        <?php
                                            if (($i + 1) % 5 == 0) {
                                                echo '</div>';
                                            }
                                            $i++;
                                    endforeach;
                                ?>
                            </div>

                            <input type="hidden" name="id_usuario" value="<?= $_SESSION['id']; ?>">

                            <input type="hidden" name="accion" value="store">

                            <button type="submit" class="btn btn-primary d-flex ms-auto">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>