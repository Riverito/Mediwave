<?php
if (!empty($_POST)) {
    $userEmail = $_POST["userEmail"];
    $pwd = $_POST["pwd"]; 

    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );

    require_once (ABSPATH .'core/functions.php');

    if (emptyInputLogin($userEmail, $pwd) !== false) {
        $response['status'] = 1;
        $response['message'] = 'Existen campos vacíos.';
        reportKill($response);
        exit();
    }

    if(!LoginUser($userEmail, $pwd)){
        $response['status'] = 2;
        $response['message'] = 'Nombre de usuario o contraseña incorrecto.';
        reportKill($response);
    } else {
        $response['status'] = 3;
        $response['message'] = 'Login exitoso';
        $response['success'] = true;
        reportKill($response);
    }



    echo json_encode($response);
} 
