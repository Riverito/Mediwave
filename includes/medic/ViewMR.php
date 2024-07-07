<?php
$idPaciente = $_GET['id'];

$conn = $GLOBALS['conn'];

$sql = "SELECT rutaArchivoRegistro FROM registros_medicos WHERE idPaciente = ?;";
$stmt = mysqli_stmt_init($conn);

// Preparar la consulta
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode(array('status' => 0, 'message' => 'Error al preparar la consulta.'));
    exit();
}

// Bind de parámetros y ejecución de la consulta
mysqli_stmt_bind_param($stmt, "s", $idPaciente);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verificar si se encontraron resultados
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $rutaArchivo = $row['rutaArchivoRegistro'];
    
    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Configurar las cabeceras para la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($rutaArchivo).'"');
        header('Content-Length: ' . filesize($rutaArchivo));
        header('Pragma: public');
        flush(); // Limpiar el buffer de salida del sistema
        readfile($rutaArchivo); // Leer el archivo y escribirlo en la salida
        exit();
    } else {
        echo json_encode(array('status' => 0, 'message' => 'Archivo no encontrado en el servidor.'));
    }
} else {
    echo json_encode(array('status' => 0, 'message' => 'No se encontró archivo médico para este paciente.'));
}


