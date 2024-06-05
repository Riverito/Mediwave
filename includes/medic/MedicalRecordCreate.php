<?php
if (!empty($_POST)) {
    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );



    var_dump($_FILES);
    var_dump($_POST);
    echo json_encode($response);
}