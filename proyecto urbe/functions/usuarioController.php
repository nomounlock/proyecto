<?php


include "db.php";

if($_POST['accion'] == 'store') {

    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $clave = $_POST['clave'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $id_permiso = 1;

    $opciones = array (
        'cost' => 12
    );

    $hash_clave = password_hash($clave, PASSWORD_BCRYPT, $opciones);

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('INSERT INTO usuarios (nombre, correo, clave, peso, altura, fecha_nacimiento, id_permiso) VALUES (?, ?, ?, ?, ?, ?, 1)');
        $stmt->bind_param('sssdis', $nombre, $correo, $hash_clave, $peso, $altura, $fecha_nacimiento);
        $stmt->execute();

        header('Location: ../index.php');
        exit();
    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }
}

if($_POST['accion'] == 'login') {

    $correo = $_POST['email'];
    $clave = $_POST['clave'];

    //Código para ingresar a usuario
    try {

        //Seleccionar el usuario de la base de datos
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT id, nombre, correo, clave, peso, altura, fecha_nacimiento, id_permiso FROM usuarios WHERE correo = ?");
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        //Iniciar sesion del usuario seleccionado
        $stmt->bind_result($id_usuario, $nombre_usuario, $correo_usuario, $pass_usuario, $peso_usuario, $altura_usuario, $fecha_usuario, $permiso_usuario);
        $stmt->fetch();

        if($nombre_usuario) { //Usuario existe
            //Verificando clave
            if(password_verify($clave , $pass_usuario)) {

                //Iniciar la sesión
                session_start();
                $_SESSION['id'] = $id_usuario;
                $_SESSION['nombre'] = $nombre_usuario;
                $_SESSION['correo'] = $correo_usuario;
                $_SESSION['peso'] = $peso_usuario;
                $_SESSION['altura'] = $altura_usuario;
                $_SESSION['fecha'] = $fecha_usuario;
                $_SESSION['permiso'] = $permiso_usuario;
                //Login correcto

                header('Location: ../index.php');
                exit();
            } else {

                //Login incorrecto
                header('Location: ../login.php?error=clave');
                exit();
            }
        } else {

            //Usuario incorrecto
                header('Location: ../login.php?error=correo');
                exit();
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        //En caso de error
        $respuesta = array (
            'pass' => $e->getMessage()
        );
    }
}