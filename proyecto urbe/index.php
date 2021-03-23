<?php include_once "functions/sesiones.php"; ?>
<?php include_once "functions/pruebas.php"; ?>

<?php
    if(isset($_GET['cerrar_sesion'])) {
        $_SESSION = array();
    }

    header('Location: index.php');
    exit();
?>

<?php include_once "includes/head.php"; ?>

<body>
    <?php include_once "includes/nav.php"; ?>

    <div class="d-flex">

        <?php
            if(revisarMedico()) {
                include_once "includes/pruebas-aside.php";
            }
        ?>
        
        <div class="container-fluid justify-content-center p-4 col">
            <div class="row gx-0">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Exámenes disponibles</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <?php
                                $pruebas = all();
                                $i = 0;

                                foreach ($pruebas as $prueba) :
                                    if ($i % 5 == 0) {
                                        echo '<div class="col">';
                                    }
                                    ?>
                                    
                                    <p><?= $prueba['nombre'] ?></p>

                                    <?php
                                        if (($i + 1) % 5 == 0) {
                                            echo '</div>';
                                        }
                                        $i++;
                                endforeach;
                            ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <p class="text-muted mb-0" style="font-size: 14px!important;">El tiempo de entrega de los resultados varía según el examen realizado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>