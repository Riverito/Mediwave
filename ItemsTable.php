<?php
include "functions.php";

$sql1 = "SELECT * FROM insumo";
$result1 = mysqli_query($conn, $sql1);

$insumos = array(); 

while ($row1 = mysqli_fetch_array($result1)) {
    $insumo = '<tr>' .
        '<td>' . $row1["NombreInsumo"] . '</td>' .
        '<td>' . $row1["Descripcion"] . '</td>' .
        '<td>' . $row1["Cantidad"] . '</td>' .
        '<td>' .
        '<button type="button" data-bs-toggle="modal" data-bs-target="#editItemModal" class="editbtn m-1 btn btn-primary" data-uid="' . $row1["idInsumo"] . '">' .
        '<i class="fa-solid fa-pen-to-square"></i>' .
        '</button>' .
        '<button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="delbtn m-1 btn btn-danger" data-uid="' . $row1["idInsumo"] . '">' .
        '<i class="fa-solid fa-trash"></i>' .
        '</button>' .
        '<button type="button"  class="m-1 btn btn-primary" data-uid="' . $row1["idInsumo"] . '">' .
        '<i class="fa-solid fa-plus"></i>' .
        '</button>' .
        '<button type="button" class="m-1 btn btn-danger" data-uid="' . $row1["idInsumo"] . '">' .
        '<i class="fa-solid fa-minus"></i>' .
        '</button>' .
        '</td>' .
        '</tr>';
    $insumos[] = $insumo;
}
echo json_encode($insumos); 
?>

