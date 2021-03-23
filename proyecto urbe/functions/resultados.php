<?php


require "db.php";

function find($id) {

    try {

        $conn = Database::connect();
        $stmt = $conn->query('SELECT r.resultado, p.nombre 
                                FROM resultados r 
                                INNER JOIN pruebas p 
                                ON r.id_prueba = p.id 
                                WHERE id_examen = '.$id);

        if($stmt->num_rows == 0) {
            
            header('Location: ver-examenes.php');
            exit();
        } else {

            return $stmt->fetch_all(MYSQLI_ASSOC);
        }

        $conn->close();
        $stmt->close();
    } catch (Exception $e) {

        echo 'Error: '.$e->getMessage();
    }
}

function verify($id) {

    try {
        
        $conn = Database::connect();
        $stmt = $conn->query('SELECT * FROM examenes WHERE id = '.$id);

        $status = $stmt->fetch_array(MYSQLI_ASSOC);

        if(is_null($status)) {

            header('Location: lista-examenes.php');
            exit();
        }

    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }
}

function relatedTests($id) {

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('SELECT p.nombre, p.id FROM resultados r 
                                INNER JOIN examenes e 
                                ON e.id = r.id_examen 
                                INNER JOIN pruebas p 
                                ON p.id = r.id_prueba 
                                WHERE r.id_examen = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $conn->close();
        $stmt->close();

    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }
}