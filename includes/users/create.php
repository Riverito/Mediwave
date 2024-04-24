<?php

$response = array(
    'status' => 0,
    'message' => 'Form submission failed'
);

$errorEmpty = false;
$errorEmail = false;

if (!empty($_POST)) {
    $formData = $_POST;

    $user_name = $formData["user_name"];
    $pwd = $formData["pwd"];

    $user_name = $formData["user_name"];
    $pwd = $formData["pwd"];
    $pwdRepeat = $formData["pwdrepeat"];
    $user_apellido = $formData["user_apellido"];
    $userCd = $formData["userCd"];
    $userEmail = $formData["userEmail"];
    $userRol = $formData["userRol"];


    if (emptyInputSignup($user_name, $pwd, $pwdRepeat, $user_apellido, $userCd, $userEmail, $userRol)) {
        $response['status'] = 1;
    } else if (invalidName($user_name)) {
        $response['status'] = 2;
    } else if (invalidSecondName($user_apellido)) {
        $response['status'] = 3;
    } else if (invalidCd($userCd)){
        $response['status'] = 4;
    } else if (pwdMatch($pwd, $pwdRepeat)){
        $response['status'] = 5;
    } else if(!valid_email($userEmail)){
        $response['status'] = 8;
    } else if(createUser($user_name, $pwd, $user_apellido, $userCd, $userEmail, $userRol) === '1062'){
        $response['status'] = 6;
    } else {
        $response['status'] = 7;
        $response['message'] = 'successful';
        echo 'Registro exitoso.';
        die();
    }
} 
$response['message'] = 'Ha ocurrido un error.';
echo json_encode($response);




