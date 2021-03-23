<?php


require "db.php";

function all() {

    try {
        
        $conn = Database::connect();
        $stmt = $conn->query('SELECT * FROM pruebas');

        return $stmt;

        $conn->close();
        $stmt->close();
    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }

}

function find($id) {

    try {

        $conn = Database::connect();
        $stmt = $conn->query('SELECT * FROM pruebas WHERE id = '.$id);

        if($stmt->num_rows == 0) {
            
            header('Location: lista-pruebas.php');
            exit();
        } else {

            return $stmt->fetch_array(MYSQLI_ASSOC);
        }

        $conn->close();
        $stmt->close();
    } catch (Exception $e) {

        echo 'Error: '.$e->getMessage();
    }
}