<?php
########################################## #################### #########################################
##########################################  FUNCIONES MEDICAS   #########################################
########################################## #################### #########################################


function emptyNewpatient($patientName, $PatientSecondName,$PatientGenre,$PatienAge)
{
    if (empty($patientName)  || empty($PatientSecondName) || empty($PatientGenre) || empty($PatienAge) ) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function createPatient($patientName, $patientLastName, $patientGenre, $patientAge, $patientCd = "") {
    $id = generateUserid();
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO pacientes (idPaciente , nombrePaciente , apellidoPaciente , cedulaPaciente, fechaNacimientoPaciente, generoPaciente) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Si hay un error al preparar la consulta, retornar el mensaje de error
        return "Error al preparar la consulta: " . mysqli_error($GLOBALS['conn']);
    }

    // Vincular los parámetros a la consulta preparada
    $success = mysqli_stmt_bind_param($stmt, "ssssss", $id, $patientName, $patientLastName, $patientCd, $patientAge, $patientGenre);
    if (!$success) {
        // Si hay un error al vincular los parámetros, retornar el mensaje de error
        mysqli_stmt_close($stmt);
        return "Error al vincular los parámetros: " . mysqli_stmt_error($stmt);
    }

    // Ejecutar la consulta preparada
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        // Si hay un error al ejecutar la consulta, retornar el mensaje de error
        mysqli_stmt_close($stmt);
        return "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);

    // Retornar null si no hay errores
    return true;
}

function patientCdExists($userCd)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM pacientes WHERE cedulaPaciente = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userCd);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) and $rowcount >= 1) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function saveFilePathToDatabase($patientId,  $fileDestination) {
    $conn = $GLOBALS['conn'];
    $currentDate = date('Y-m-d');

    // Assuming $filePath contains just the filename after move_uploaded_file
    $normalizedUrl =  $fileDestination;

    $sql = "INSERT INTO registros_medicos (idRegistro, idPaciente, fechaRegistro, rutaArchivoRegistro) VALUES (UUID(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Error al preparar la consulta: " . $conn->error);
        return false;
    }

    $stmt->bind_param("sss", $patientId, $currentDate, $normalizedUrl);
    $result = $stmt->execute();
    $stmt->close();

    if (!$result) {
        error_log("Error al ejecutar la consulta: " . $conn->error);
        return false;
    }
    
    return true;
}

function delpacient($pacienId)
{
    $conn = $GLOBALS['conn'];

    $sql = "DELETE FROM pacientes WHERE idPaciente = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Error al preparar la consulta en deleteItem: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $pacienId);

    if (!mysqli_stmt_execute($stmt)) {
        $errorCode = mysqli_stmt_errno($stmt);
        mysqli_stmt_close($stmt);

        if ($errorCode == 1451) {
            // Error 1451: Cannot delete or update a parent row: a foreign key constraint fails
            return 'Por favor contacte un administrador';
        } else {
            return 'Error al ejecutar la consulta en eliminar paciente: ' . mysqli_stmt_error($stmt);
        }
    }

    // Verificar las filas afectadas antes de cerrar el statement
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($affectedRows > 0) {
        return 'Paciente eliminado correctamente';
    } else {
        return 'Paciente no encontrado';
    }
}

function updatePatient($id, $patientName, $patientLastName, $patientCd, $patientBirthdate, $patientGender) {
    // SQL para actualizar los datos del paciente
    $sql = "UPDATE pacientes 
            SET nombrePaciente = ?, 
                apellidoPaciente = ?, 
                cedulaPaciente = ?, 
                fechaNacimientoPaciente = ?, 
                generoPaciente = ?
            WHERE idPaciente = ?";

    // Inicializar la declaración preparada
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Si hay un error al preparar la consulta, retornar el mensaje de error
        return "Error al preparar la consulta: " . mysqli_error($GLOBALS['conn']);
    }

    // Vincular los parámetros a la consulta preparada
    $success = mysqli_stmt_bind_param($stmt, "ssssss", $patientName, $patientLastName, $patientCd, $patientBirthdate, $patientGender, $id);
    if (!$success) {
        // Si hay un error al vincular los parámetros, retornar el mensaje de error
        mysqli_stmt_close($stmt);
        return "Error al vincular los parámetros: " . mysqli_stmt_error($stmt);
    }

    // Ejecutar la consulta preparada
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        // Si hay un error al ejecutar la consulta, retornar el mensaje de error
        mysqli_stmt_close($stmt);
        return "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
    }


    mysqli_stmt_close($stmt);

    return true;
}