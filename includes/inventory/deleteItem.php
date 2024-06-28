<?php
if (!empty($_POST)) {

    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );

    // Suponiendo que $itemId se obtiene de $_POST
    $itemId = $_POST['uid'];  // Ajusta según sea necesario

    // Llamamos a la función deleteItem y capturamos el resultado
    $result = deleteItem($itemId);

    if ($result === 'El articulo posee movimientos, por favor contacte un administrador.') {
        $response = array(
            'status' => 1,
            'message' => 'El artículo posee movimientos, por favor contacte a un administrador'
        );
        reportKill($response);
    } elseif ($result === 'Artículo eliminado correctamente') {
        $response = array(
            'status' => 2,
            'message' => 'Eliminado satisfactoriamente.'
        );
        reportKill($response);
    } elseif ($result === 'Artículo no encontrado') {
        $response = array(
            'status' => 3,
            'message' => 'Artículo no encontrado.'
        );
        reportKill($response);
    } else {
        $response['message'] = $result;  // Retornar el mensaje de error específico
        reportKill($response);
    }

    // Este echo no se alcanzará si reportKill detiene la ejecución del script
    echo json_encode($response);
}
?>
