<?php
if (!empty($_POST)) {

    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );


    $patient = $_POST['uid'];  

    // Llamamos a la función deleteItem y capturamos el resultado
    $result = delpacient($patient);

    if ($result === 'Por favor contacte un administrador') {
        $response = array(
            'status' => 1,
            'message' => 'Por favor contacte a un administrador'
        );
        reportKill($response);
    } elseif ($result === 'Paciente eliminado correctamente') {
        $response = array(
            'status' => 2,
            'message' => 'Eliminado satisfactoriamente.'
        );
        reportKill($response);
    } elseif ($result === 'Paciente no encontrado.') {
        $response = array(
            'status' => 3,
            'message' => 'Paciente no encontrado.'
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
