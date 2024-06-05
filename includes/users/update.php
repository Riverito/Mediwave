<?php

$response = array(
    'status' => 0,
    'message' => 'Ha ocurrido un error.'
);

if (!empty($_POST)) {
    

    if (editEmptyInputSignup($_POST["editNombre"], $_POST["editApellido"], $_POST["editUserCd"], $_POST["editMail"], $_POST["editRol"])) {
        $response['status'] = 1;
        $response['message'] = 'Existen campos vacíos.';
        reportKill($response);
    }

    if (invalidName($_POST["editNombre"]) or invalidName($_POST["editApellido"])) {
        $response['status'] = 2;
        $response['message'] = 'No incluya caracteres especiales en el nombre';
        reportKill($response);
    }

    if (invalidCd($_POST["editUserCd"])) {
        $response['status'] = 3;
        $response['message'] = 'Cédula inválida';
        reportKill($response);
    }

    // if (cdExists($_POST["editUserCd"])) {
    //     $response['status'] = 4;
    //     $response['message'] = 'La cédula ya esta registrada.';
    //     reportKill($response);
    // }

    if (!valid_email($_POST["editMail"])) {
        $response['status'] = 5;
        $response['message'] = 'El correo no es válido.';
        reportKill($response);
    } else {
        $filteredEmail = valid_email($_POST["editMail"]);
    }

    // if (emailExists($filteredEmail)) {
    //     $response['status'] = 6;
    //     $response['message'] = 'Este correo ya fue registrado.';
    //     reportKill($response);
    // }

    if (editUser($_POST["editNombre"], $_POST["editApellido"], $_POST["editUserCd"], $_POST["editMail"], $_POST["editRol"], $_POST["uid"])) {
        $response['status'] = 20;
        $response['message'] = 'Se edito';
    }
}
echo json_encode($response);
