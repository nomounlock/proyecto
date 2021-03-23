<?php


include "db.php";

if($_POST['accion'] == 'store') {

    $nombre = $_POST['nombre'];

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('INSERT INTO pruebas (nombre) VALUES (?)');
        $stmt->bind_param('s', $nombre);
        $stmt->execute();

        $conn->close();
        $stmt->close();

        header('Location: ../lista-pruebas.php');
        exit();

    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }
}

if($_POST['accion'] == 'delete') {

    $id = $_POST['id'];

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('DELETE FROM pruebas WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {

            header('Location: ../lista-pruebas.php');
            exit();
        }

        $conn->close();
        $stmt->close();

    } catch (Exception $e) {
        echo 'Error: '.$e->getMessage();
    }
}

if($_POST['accion'] == 'update') {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('UPDATE pruebas SET nombre = ? WHERE id = ?');
        $stmt->bind_param('si', $nombre, $id);
        $stmt->execute();

        $conn->close();
        $stmt->close();

        header('Location: ../lista-pruebas.php');
        exit();

    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }
}