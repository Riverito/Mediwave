<?php
$errorEmpty = false;
$errorEmail = false;

if (!empty($_POST)) {
    $response = array(
        'status' => 0,
        'message' => 'Fallo alguna función'
    );

    require_once 'functions.inc.php';
    $formData = $_POST;


    $userId = $_POST["uid"];
    $user_name = $formData["editNombre"];
    $user_apellido = $formData["editApellido"];
    $userCd = $formData["editUserCd"];
    $userEmail = $formData["editMail"];
    $userRol = $formData["editRol"];

    if (editEmptyInputSignup($user_name, $user_apellido, $userCd, $userEmail, $userRol) !== false) {
        $response['status'] = 1;
        $response['message'] = 'Campo vacío';
    } else if (invalidName($user_name) !== false) {
        $response['status'] = 2;
        $response['message'] = 'No incluya caracteres especiales en el nombre';
    } else if (invalidSecondName($user_apellido) !== false) {
        $response['status'] = 3;
        $response['message'] = 'Apellido inválido';
    } else if (invalidCd($userCd) !== false) {
        $response['status'] = 4;
        $response['message'] = 'Cédula inválida';
    } else if (!valid_email($userEmail)) {
        $response['status'] = 9;
        $response['message'] = 'Correo invalido';
    } else if (editUser($user_name, $user_apellido, $userCd, $userEmail, $userRol, $userId) === '1062') {
        $response['status'] = 5;
    } else if (editUser($user_name, $user_apellido, $userCd, $userEmail, $userRol, $userId) === 'success') {
        $response['status'] = 6;
        $response['message'] = 'Se edito';
    } else {
        $response['status'] = 88;
        $response['message'] = 'Algo salio mal';
    }
}

echo json_encode($response);
