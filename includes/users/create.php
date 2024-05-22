<?php
if (!empty($_POST)) {

    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );

    if (emptyInputSignup($_POST["user_name"], $_POST["pwd"], $_POST["pwdrepeat"], $_POST["user_apellido"], $_POST["userCd"], $_POST["userEmail"], $_POST["userRol"])) {
        $response['status'] = 1;
        $response['message'] = 'Existen campos vacíos.';
        reportKill($response);
    }

    if (invalidName($_POST["user_name"]) or invalidName($_POST["user_apellido"])) {
        $response['status'] = 2;
        $response['message'] = 'El nombre o Apellido no son validos.';
        reportKill($response);
    }

    if (!pwdMatch($_POST["pwd"], $_POST["pwdrepeat"])) {
        $response['status'] = 3;
        $response['message'] = 'Las contraseñas no coinciden.';
        reportKill($response);
    }

    if (invalidCd($_POST["userCd"])) {
        $response['status'] = 4;
        $response['message'] = 'Su cédula no es valida.';
        reportKill($response);
    }

    if (cdExists($_POST["userCd"])) {
        $response['status'] = 5;
        $response['message'] = 'La cédula ya esta registrada.';
        reportKill($response);
    }

    if (!valid_email($_POST["userEmail"])) {
        $response['status'] = 6;
        $response['message'] = 'El correo no es válido.';
        reportKill($response);
    } else {
        $filteredEmail = valid_email($_POST["userEmail"]);
    }

    if (emailExists($filteredEmail)) {
        $response['status'] = 7;
        $response['message'] = 'Este correo ya fue registrado.';
        reportKill($response);
    }

    if( createUser($_POST["user_name"], $_POST["pwd"], $_POST["user_apellido"], $_POST["userCd"], $_POST["userEmail"], $_POST["userRol"]) ){
        $response['status'] = 20;
        $response['message'] = 'Registro exitoso.';
    }
}
echo json_encode($response);
