<?php


require "db.php";

function all() {

    try {
        
        $conn = Database::connect();
        $stmt = $conn->query('SELECT * FROM examenes');

        return $stmt;

        $conn->close();
        $stmt->close();
    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }

}

function joinUsersAll($status = "esperando resultados") {

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('SELECT e.id, e.fecha, u.nombre 
                                FROM examenes e 
                                INNER JOIN usuarios u 
                                ON e.id_usuario = u.id 
                                WHERE e.status = ? 
                                ORDER BY e.fecha ASC');
        $stmt->bind_param('s', $status);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $conn->close();
        $stmt->close();

    } catch (Exception $e) {
        echo 'Error: '.$e->getMessage();
    }
}

function find($id) {

    try {

        $conn = Database::connect();
        $stmt = $conn->query('SELECT * FROM examenes WHERE id_usuario = '.$id.' ORDER BY fecha DESC');

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