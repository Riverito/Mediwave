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
    }

    if (emptyNewpatient($_POST["patientName"], $_POST["patientLastname"], $_POST["patientBirthdate"], $_POST["patientGenre"])) {
        $response['status'] = 1;
        $response['message'] = 'Existen campos vacíos.';
        reportKill($response);
    }

    if (invalidName($_POST["patientName"]) || invalidSecondName($_POST["patientLastname"])) {
        $response['status'] = 4;
        $response['message'] = 'No incluya caracteres especiales en el nombre o apellido.';
        reportKill($response);
    }

    if (updatePatient($_POST["uid"], $_POST["patientName"], $_POST["patientLastname"], $_POST["patientCd"], $_POST["patientBirthdate"], $_POST["patientGenre"])) {
        $response['status'] = 20;
        $response['message'] = 'El paciente fue actualizado con éxito.';
        reportKill($response);
    } else {
        $response['status'] = 5;
        $response['message'] = 'Ha ocurrido un error al actualizar el paciente.';
        reportKill($response);
    }
}
echo json_encode($response);
