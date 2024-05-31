<?php
if (!empty($_POST)) {
    $response = array(
        'status' => 0,
        'message' => 'Ha ocurrido un error.'
    );

    if (isset($_POST["HasCd"]) && $_POST["HasCd"] == "on") {
        if (empty($_POST["patientCd"])) {
            $response['status'] = 1;
            $response['message'] = 'Existen campos vacíos.';
            reportKill($response);
        }

        if (invalidCd($_POST["patientCd"])) {
            $response['status'] = 2;
            $response['message'] = 'La cédula no es válida.';
            reportKill($response);
        }

        if(patientCdExists($_POST["patientCd"])){
            $response['status'] = 3;
            $response['message'] = 'Esta cedula ya ha sido registrada';
            reportKill($response);
        }
    }

    if (emptyNewpatient($_POST["patientName"], $_POST["patientLastname"], $_POST["patientAge"], $_POST["patientGenre"])) {
        $response['status'] = 1;
        $response['message'] = 'Existen campos vacíos.';
        reportKill($response);
    }

    if (invalidName($_POST["patientName"]) || invalidSecondName($_POST["patientLastname"])) {
        $response['status'] = 4;
        $response['message'] = 'No incluya caracteres especiales en el nombre o apellido.';
        reportKill($response);
    }

    if (createPatient($_POST["patientName"], $_POST["patientLastname"], $_POST["patientGenre"], $_POST["patientAge"], $_POST["patientCd"])) {
        $response['status'] = 20;
        $response['message'] = 'El paciente fue creado con éxito.';
        reportKill($response);
    }

   else {
        $response['status'] = 5;
        $response['message'] = 'Ha ocurrido un error al crear al paciente: ' . createPatient($_POST["patientName"], $_POST["patientLastname"], $_POST["patientAge"], $_POST["patientGenre"], $_POST["patientCd"]);
        reportKill($response);
    }
}
echo json_encode($response);
