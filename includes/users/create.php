<?php

$response = array(
    'status' => 0,
    'message' => 'Ha ocurrido un error.'
);

$errorEmpty = false;
$errorEmail = false;

if (!empty($_POST)) {
    if (emptyInputSignup( $_POST["user_name"], $_POST["pwd"], $_POST["pwdrepeat"], $_POST["user_apellido"], $_POST["userCd"], $_POST["userEmail"], $_POST["userRol"])) {
        $response['status'] = 1;
        reportKill($response);
    }

    if (invalidName($_POST["user_name"]) or invalidName($_POST["user_apellido"])) {
        $response['status'] = 2;
        reportKill($response);
    }

    if (invalidCd($_POST["userCd"])){
        $response['status'] = 3;
        reportKill($response);
    }

    if (pwdMatch($_POST["pwd"], $_POST["pwdrepeat"])){
        $response['status'] = 4;
        reportKill($response);
    }
    if(!valid_email($_POST["userEmail"])){
        $response['status'] = 5;
        reportKill($response);
    }
    
    if( createUser($_POST["user_name"], $_POST["pwd"], $_POST["user_apellido"], $_POST["userCd"], $_POST["userEmail"], $_POST["userRol"]) ){
        $response['status'] = 20;
        $response['message'] = 'Registro exitoso.';
    }
}
echo json_encode($response);





