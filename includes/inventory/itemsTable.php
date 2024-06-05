<?php
$conn = $GLOBALS['conn'];
$sql = "SELECT * FROM inventario";
$result = mysqli_query($conn, $sql);
$row_inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

$inventoryItems = array();

foreach ($row_inventory as $row) {
    // Crear un objeto para cada elemento del inventario
    $item = array(
        'nameItem' => $row["nombreArticulo"],
        'descriptionItem' => $row["descripcionArticulo"],
        'countItem' => $row["cantidadArticulo"],
        'idItem' => $row["idArticulo"]
    );

    $inventoryItems[] = $item;
}

echo json_encode($inventoryItems);
?>
