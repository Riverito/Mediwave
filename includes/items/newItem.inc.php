<?php
$response = array(
    'status' => 0,
    'message' => 'Form submission failed'
);

$errorEmpty = false;
$errorEmail = false;

if (!empty($_POST)) {
    require_once '../functions.inc.php';
    $formData = $_POST;

    $item_name = $formData["itemName"];
    $item_description = $formData["NewItemDescripcion"];
    $item_count = $formData["NewItemCount"];

    $response['status'] = (createItem($conn, $item_name, $item_description, $item_count));
}


echo json_encode($response);
