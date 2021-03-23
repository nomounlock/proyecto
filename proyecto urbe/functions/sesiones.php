<?php

    function usuarioAutenticado() {
        if(!revisarUsuario()) {

            header('Location: login.php');
            exit();
        }
    }

    function revisarUsuario() {
        return isset($_SESSION['nombre']);
    }

    function revisarMedico() {

        if(revisarUsuario()) {

            if($_SESSION['permiso'] == 2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function medicoAutenticado() {

        if(!revisarMedico()) {

            header('Location: index.php');
            exit();
        }
    }

    session_start();
?>