<?php


class Database {

    public static function connect() {

        $conn = new mysqli('localhost', 'root', '', 'medicina');
        $conn->query("SET NAMES 'utf8'");

        if ($conn->connect_error) {
            die('Error de Conexión (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
        }
            
        return $conn;
    }
}