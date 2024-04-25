<?php

$response = array(
    'status' => 0,
    'message' => 'Ha ocurrido un error.'
);

$errorEmpty = false;
$errorEmail = false;

if (!empty($_POST)) {
    //Utiliza condicionales de guardia mamaguebador xd
    //Utiliza sólo ifs, si es true la condicion entonces cambia el status.
    //Si después de cambiar el código de status también necesitas un mensaje custom, mándalo desde acá, no desde el js.
    //Acuerdate que el código procedural va de arriba a abajo, intenta hacer un proceso en el cual las condiciones de guardia
    //detengan el proceso si se llegan a cumplir. Sólo con ifs, no es necesario el else if.
    
    if (emptyInputSignup( $_POST["user_name"], $_POST["pwd"], $_POST["pwdrepeat"], $_POST["user_apellido"], $_POST["userCd"], $_POST["userEmail"], $_POST["userRol"])) {
        $response['status'] = 1;
    }

    if (invalidName($_POST["user_name"]) or invalidName($_POST["user_apellido"])) {
        $response['status'] = 2;
    }

    if (invalidCd($_POST["userCd"])){
        $response['status'] = 3;
    }

    if (pwdMatch($_POST["pwd"], $_POST["pwdrepeat"])){
        $response['status'] = 4;
    }
    if(!valid_email($_POST["userEmail"])){
        $response['status'] = 5;
    }

    createUser($user_name, $pwd, $user_apellido, $userCd, $userEmail, $userRol);
}
echo json_encode($response);





