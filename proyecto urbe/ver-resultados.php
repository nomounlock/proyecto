<?php include_once "functions/sesiones.php"; ?>
<?php usuarioAutenticado(); ?>
<?php include_once "functions/resultados.php"; ?>

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
            <div class="col-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Lista de exámenes</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover m-0">
                            <thead>
                                <tr>
                                    <th scope="col">Prueba</th>
                                    <th scope="col">Resultado</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach (find($_GET['id']) as $resultado) : ?>
                                    <tr>
                                        <td scope="row" class="align-middle"><?= $resultado['nombre']; ?></td>

                                        <?php if($resultado['resultado'] == 'negativo') : ?>
                                            <td class="align-middle text-success"><?= $resultado['resultado']; ?></td>
                                        <?php else : ?>
                                            <td class="align-middle text-danger"><?= $resultado['resultado']; ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>