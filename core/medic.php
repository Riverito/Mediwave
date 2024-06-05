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

function createPatient($patientName, $patientLastName, $patientGenre, $patientAge, $patientCd) {
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