<?php
$conn = $GLOBALS['conn'];
$sql = "SELECT * FROM patients";
$result = mysqli_query($conn, $sql);
$row_inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

$inventoryItems = array();

foreach ($row_inventory as $row) {
    $patient = array(
        'PatienName' => $row["patientName"],
        'patientLastName' => $row["patientLastName"],
        'patientCd' => $row["patientCd"],
        'patientDOB' => $row["patientDOB"],
        'patientGender' => $row["patientGender"],
        'idPatient' => $row["idPatient"]

    );

    $patients[] = $patient;
}

echo json_encode($patients);
?>
