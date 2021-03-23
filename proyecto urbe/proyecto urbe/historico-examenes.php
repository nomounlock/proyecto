<?php include_once "functions/sesiones.php"; ?>
<?php medicoAutenticado(); ?>

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
            <div class="col-8">
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
                                    <th scope="col">Paciente</th>
                                    <th scope="col" style="width: 180px;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach(joinUsersAll("resultados listos") as $examen) : ?>
                                    <tr>
                                        <th scope="row" class="align-middle"><?= $examen['id']; ?></th>

                                        <td class="align-middle"><?= date_format(date_create($examen['fecha']), 'd / m / Y'); ?></td>

                                        <td class="align-middle"><?= $examen['nombre']; ?></td>

                                        <td class="align-middle">
                                            <div class="btn-toolbar">
                                                <div class="btn-group">
                                                    <a href="ver-resultados.php?id=<?= $examen['id'] ?>" class="btn btn-primary">Ver resultados</a>
                                                </div>
                                            </div>
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