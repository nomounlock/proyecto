<?php include_once "functions/sesiones.php"; ?>
<?php medicoAutenticado(); ?>
<?php include_once "functions/resultados.php"; ?>
<?php verify($_GET['id']); ?>

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
            <div class="col-7">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Agregar resultados</h4>
                    </div>

                    <div class="card-body">
                        <form action="functions/resultadoController.php" method="POST">
                            <table class="table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col" style="width: 180px;">Resultado</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach(relatedTests($_GET['id']) as $index => $resultado) : ?>
                                        <tr>
                                            <input type="hidden" name="resultados[<?= $index; ?>][id_prueba]" value="<?= $resultado['id']; ?>">

                                            <th scope="row" class="align-middle"><?= $resultado['id']; ?></th>

                                            <td class="align-middle"><?= $resultado['nombre']; ?></td>

                                            <td class="align-middle">
                                                <select name="resultados[<?= $index; ?>][resultado]" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected disabled>Resultado...</option>
                                                    <option value="positivo">Positivo</option>
                                                    <option value="negativo">Negativo</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <input type="hidden" name="id_examen" value="<?= $_GET['id']; ?>">
                            <input type="hidden" name="id_medico" value="<?= $_SESSION['id']; ?>">
                            <input type="hidden" name="accion" value="update">

                            <button type="submit" class="btn btn-primary d-flex ms-auto mt-3">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>