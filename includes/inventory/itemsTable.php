<?php
$conn = $GLOBALS['conn'];
$sql = "SELECT * FROM inventory";
$result = mysqli_query($conn, $sql);
$row_inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

$inventoryItems = array();

foreach ($row_inventory as $row) {
    // Crear un objeto para cada elemento del inventario
    $item = array(
        'nameItem' => $row["nameItem"],
        'descriptionItem' => $row["descriptionItem"],
        'countItem' => $row["countItem"],
        'idItem' => $row["idItem"]
    );

    $inventoryItems[] = $item;
}

echo json_encode($inventoryItems);
?>
