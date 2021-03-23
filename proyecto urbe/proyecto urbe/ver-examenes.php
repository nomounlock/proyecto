<?php include_once "functions/sesiones.php"; ?>
<?php usuarioAutenticado(); ?>
<?php include_once "functions/examenes.php"; ?>

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
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Lista de exámenes</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover m-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Estatus</th>
                                    <th scope="col" style="width: 90px;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach (find($_SESSION['id']) as $examen) : ?>
                                    <tr>
                                        <th scope="row" class="align-middle"><?= $examen['id']; ?></th>

                                        <td class="align-middle"><?= date_format(date_create($examen['fecha']), 'd / m / Y'); ?></td>

                                        <?php if($examen['status'] != 'esperando resultados') : ?>

                                            <td class="align-middle text-success"><?= $examen['status']; ?></td>
                                        <?php else : ?>

                                            <td class="align-middle text-warning"><?= $examen['status']; ?></td>
                                        <?php endif; ?>
                                            
                                        <td class="align-middle">
                                            <?php if($examen['status'] != 'esperando resultados') : ?>
                                                <div class="btn-toolbar">
                                                    <div class="btn-group">
                                                        <a href="ver-resultados.php?id=<?= $examen['id']; ?>" class="btn btn-info text-white">Resultados</a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
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