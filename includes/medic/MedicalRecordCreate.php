<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = array(
    'status' => 0,
    'message' => 'Ha ocurrido un error.'
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_FILES['fileUpload']['name'])) {
        $response['status'] = 1;
        $response['message'] = 'No se ha subido ningún archivo.';
        reportKill($response);
    }
    
    $patientId = $_POST['patient_id'];
    $file = $_FILES['fileUpload'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Extensiones permitidas
    $allowedExtensions = array('doc', 'docx');
    $fileExtensionArray = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtensionArray));
 

    if (!in_array($fileExtension, $allowedExtensions)) {
        $response['status'] = 2;
        $response['message'] = 'Tipo de archivo no permitido. Solo .doc y .docx.';
        reportKill($response);
    }

    if ($fileError !== 0) {
        $response['status'] = 3;
        $response['message'] = 'Hubo un error al subir el archivo.';
        reportKill($response);
    }

    if ($fileSize > 10485760) {
        $response['status'] = 4;
        $response['message'] = 'El archivo es demasiado grande. Máximo 10MB.';
        reportKill($response);
    }

    $newFilename = "mrec_$patientId.$fileExtension";
    $fileDestination = RECORDS_DIR . $newFilename;

    if (!is_dir( RECORDS_DIR )) {
        mkdir( RECORDS_DIR, 0777, true);
    }

    if (move_uploaded_file($fileTmpName, $fileDestination) == false) {
        $response['status'] = 5;
        $response['message'] = 'Error al mover el archivo.';
        reportKill($response);
    }

    if (saveFilePathToDatabase($patientId, $fileDestination)) {
        $response['status'] = 100;
        $response['message'] = 'Archivo subido con éxito.';
        reportKill($response);
    }
}
echo json_encode($response);
