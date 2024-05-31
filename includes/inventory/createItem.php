<?php
if (!empty($_POST)) {

    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );

    if (emptyNewItem($_POST["Itemname"], $_POST["itemDescription"])) {
        $response['status'] = 1;
        $response['message'] = 'Existen campos vacíos.';
        reportKill($response);
    }

    if (invalidItem($_POST["Itemname"]) or invalidItem($_POST["itemDescription"])) {
        $response['status'] = 2;
        $response['message'] = 'No se permiten caracteres especiales.';
        reportKill($response);
    }

    if(itemExists($_POST["Itemname"])){
        $response['status'] = 3;
        $response['message'] = 'Este insumo ya fue registrado';
        reportKill($response);
    }

    if( createItem($_POST["Itemname"], $_POST["itemDescription"]) ){
        $response['status'] = 20;
        $response['message'] = 'Registro exitoso.';
        reportKill($response);
    }

    var_dump($response);
}


echo json_encode($response);
