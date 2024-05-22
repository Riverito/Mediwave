<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );

    // Validación de campos vacíos
    $requiredFields = ['itemName', 'itemQuantity', 'operation', 'itemId', 'ajustRazon'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $response['status'] = 1;
            $response['message'] = 'Existen campos vacíos.';
            echo json_encode($response);
            exit();
        }
    }

    if (
        count($_POST['itemName']) !== count($_POST['itemQuantity']) ||
        count($_POST['itemName']) !== count($_POST['operation']) ||
        count($_POST['itemName']) !== count($_POST['itemId'])
    ) {
        $response['status'] = 2;
        $response['message'] = 'Inconsistencias en los datos.';
        reportKill($response);
    }

    $itemNames = array_map('trim', $_POST['itemName']);
    $itemQuantities = array_map('intval', $_POST['itemQuantity']);
    $operations = array_map('trim', $_POST['operation']);
    $itemIds = array_map('trim', $_POST['itemId']);
    $ajustRazon = trim($_POST['ajustRazon']);

    $conn = $GLOBALS['conn'];
    $conn->begin_transaction();

    try {
        for ($i = 0; $i < count($itemNames); $i++) {
            $itemName = $itemNames[$i];
            $itemQuantity = $itemQuantities[$i];
            $operation = $operations[$i];
            $itemId = $itemIds[$i];

            if (!updateInventory($itemId, $itemQuantity, $operation)) {
                throw new Exception("Error al actualizar el inventario para el ítem: " . $itemName);
            }

            if (!logAdjustment($itemId, $itemQuantity, $operation, $ajustRazon)) {
                throw new Exception("Error al registrar el ajuste para el ítem: " . $itemName);
            }
        }

        $conn->commit();
        $response['status'] = 20;
        $response['message'] = 'Ajuste realizado con éxito.';
    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = $e->getMessage();
    }

    reportKill($response);
} else {
    $response['status'] = 3;
    $response['message'] = 'Método de solicitud no válido.';
    reportKill($response);
}
