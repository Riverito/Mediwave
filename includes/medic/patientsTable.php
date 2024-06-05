<?php
$conn = $GLOBALS['conn'];
$sql = "SELECT * FROM pacientes";
$result = mysqli_query($conn, $sql);
$row_inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

$inventoryItems = array();

foreach ($row_inventory as $row) {
    $patient = array(
        'PatienName' => $row["nombrePaciente"],
        'patientLastName' => $row["apellidoPaciente"],
        'patientCd' => $row["cedulaPaciente"],
        'patientDOB' => $row["fechaNacimientoPaciente"],
        'patientGender' => $row["generoPaciente"],
        'idPatient' => $row["idPaciente"]
    );

    $patients[] = $patient;
}

echo json_encode($patients);
?>
