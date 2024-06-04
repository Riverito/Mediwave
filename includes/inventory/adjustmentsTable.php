<?php
$conn = $GLOBALS['conn'];

// Consulta SQL para obtener los datos requeridos
$sql = "
    SELECT 
        inventory.nameItem, 
        users.usersName, 
        inventory_adjustments.adjustmentAmount, 
        inventory_adjustments.adjustmentReason,
        inventory_adjustments.adjustmentDateTime
    FROM 
        inventory_adjustments 
    JOIN 
        inventory ON inventory_adjustments.itemId = inventory.idItem 
    JOIN 
        users ON inventory_adjustments.userId = users.idUsuario
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
        'nameItem' => $row["nameItem"],
        'usersName' => $row["usersName"],
        'adjustmentAmount' => $row["adjustmentAmount"],
        'adjustmentReason' => $row["adjustmentReason"],
        'adjustmentDateTime' => $row["adjustmentDateTime"]
    );

    $adjustments[] = $adjustment;
}
echo json_encode($adjustments);
?>
