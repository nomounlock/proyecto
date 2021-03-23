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
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Lista de pruebas</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover m-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col" style="width: 180px;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach (all() as $prueba) : ?>
                                    <tr>
                                        <th scope="row" class="align-middle"><?= $prueba['id']; ?></th>

                                        <td class="align-middle"><?= $prueba['nombre']; ?></td>

                                        <td class="align-middle">
                                            <div class="btn-toolbar">
                                                <div class="btn-group me-2">
                                                    <a href="editar-prueba.php?id=<?= $prueba['id'] ?>" class="btn btn-warning">Editar</a>
                                                </div>

                                                <div class="btn-group">
                                                    <form action="functions/pruebaController.php" method="POST">
                                                        <input type="hidden" name="accion" value="delete">
                                                        <input type="hidden" name="id" value="<?= $prueba['id']; ?>">

                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
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