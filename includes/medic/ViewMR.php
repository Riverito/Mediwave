<?php
// Verificar si se ha proporcionado un ID válido
if (!isset($_GET['id'])) {
    echo json_encode(array('status' => 0, 'message' => 'ID de paciente no proporcionado.'));
    exit();
}

// Obtener el ID del paciente desde el parámetro GET
$idPaciente = $_GET['id'];

$conn = $GLOBALS['conn']; // Usando la conexión global, asegúrate de que $GLOBALS['conn'] esté correctamente configurado en tu aplicación

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
    echo json_encode(array('status' => 1, 'filePath' => $rutaArchivo));
} else {
    echo json_encode(array('status' => 0, 'message' => 'No se encontró archivo médico para este paciente.'));
}
?>
