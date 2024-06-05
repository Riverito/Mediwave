<?php
$conn = $GLOBALS['conn'];

// Consulta SQL para obtener los datos requeridos
$sql = "
    SELECT 
        inventario.nombreArticulo, 
        usuarios.nombreUsuario, 
        ajustes_inventario.cantidadAjuste, 
        ajustes_inventario.razonAjuste,
        ajustes_inventario.fechaHoraAjuste
    FROM 
        ajustes_inventario 
    JOIN 
        inventario ON ajustes_inventario.idArticulo = inventario.idArticulo 
    JOIN 
        usuarios ON ajustes_inventario.idUsuario = usuarios.idUsuario
";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

$row_adjustments = mysqli_fetch_all($result, MYSQLI_ASSOC);

$adjustments = array();


foreach ($row_adjustments as $row) {
    // Crear un objeto para cada ajuste del inventario
    $adjustment = array(
        'nameItem' => $row["nombreArticulo"],
        'usersName' => $row["nombreUsuario"],
        'adjustmentAmount' => $row["cantidadAjuste"],
        'adjustmentReason' => $row["razonAjuste"],
        'adjustmentDateTime' => $row["fechaHoraAjuste"]
    );

    $adjustments[] = $adjustment;
}
echo json_encode($adjustments);
?>
