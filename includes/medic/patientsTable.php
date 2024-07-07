<?php
$conn = $GLOBALS['conn'];

$pacientes = 'SELECT * FROM pacientes';
$registros = 'SELECT idPaciente FROM registros_medicos';

$resultPacientes = mysqli_query($conn, $pacientes);
if (!$resultPacientes) {
    die('Error en la consulta de pacientes: ' . mysqli_error($conn));
}
$row_inventory_pacientes = mysqli_fetch_all($resultPacientes, MYSQLI_ASSOC);

$patients = [];
foreach ($row_inventory_pacientes as $row) {
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

$resultRegistro = mysqli_query($conn, $registros);
if (!$resultRegistro) {
    die('Error en la consulta de registros: ' . mysqli_error($conn));
}
$row_inventory_registros = mysqli_fetch_all($resultRegistro, MYSQLI_ASSOC);

$registros = [];
foreach ($row_inventory_registros as $row) {
    $registro = array(
        'idPatient' => $row["idPaciente"]
    );

    $registros[] = $registro;
}

$data = [
    'patients' => $patients,
    'registros' => $registros
];

echo json_encode($data);


