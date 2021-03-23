<?php


include "db.php";

if($_POST['accion'] == 'store') {

    $id = $_POST['id_usuario'];
    $pruebas = $_POST['pruebas'];

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('INSERT INTO examenes (id_usuario, fecha, status) VALUES (?, NOW(), "esperando resultados")');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $id_examen = $stmt->insert_id;

        foreach ($pruebas as $prueba) {

            $stmt2 = $conn->prepare('INSERT INTO resultados (id_examen, id_prueba) VALUES (?, ?)');
            $stmt2->bind_param('ii', $id_examen, $prueba);
            $stmt2->execute();
        }

        $conn->close();
        $stmt->close();

        header('Location: ../ver-examenes.php');
        exit();

    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }
}