<?php

$response = array(
    'status' => 0,
    'message' => 'Ha ocurrido un error.'
);

$errorEmpty = false;
$errorEmail = false;

if (!empty($_POST)) {

    if (emptyInputSignup($_POST["user_name"], $_POST["pwd"], $_POST["pwdrepeat"], $_POST["user_apellido"], $_POST["userCd"], $_POST["userEmail"], $_POST["userRol"])) {
        $response['status'] = 1;
        reportKill($response);
    }

    if (invalidCd($_POST["userCd"])) {
        $response['status'] = 2;
        reportKill($response);
    }

    if (cdExists($_POST["userCd"])) {
        $response['status'] = 3;
        reportKill($response);
    }

    if (!valid_email($_POST["userEmail"])) {
        $response['status'] = 4;
        reportKill($response);
    } else {
        $filteredEmail = valid_email($_POST["userEmail"]);
    }

    if (emailExists($filteredEmail)) {
        $response['status'] = 5;
        reportKill($response);
    }

    if (invalidName($_POST["user_name"]) or invalidName($_POST["user_apellido"])) {
        $response['status'] = 6;
        reportKill($response);
    }

    if (!pwdMatch($_POST["pwd"], $_POST["pwdrepeat"])) {
        $response['status'] = 7;
        reportKill($response);
    }

    if( createUser($_POST["user_name"], $_POST["pwd"], $_POST["user_apellido"], $_POST["userCd"], $_POST["userEmail"], $_POST["userRol"]) ){
        $response['status'] = 20;
        $response['message'] = 'Registro exitoso.';
    }
}
echo json_encode($response);
