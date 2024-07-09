<?php
########################################## #################### #########################################
########################################## FUNCIONES INVENTARIO #########################################
########################################## #################### #########################################


function emptyNewItem($itemName, $ItemDrescription)
{

    if (empty($itemName)  || empty($ItemDrescription)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidItem($user_name)
{
    // La expresión regular incluye letras (con y sin acentos), la letra ñ, y espacios.
    if (preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$/", $user_name)) {
        return false;
    }
    return true;
}

function itemExists($itemName)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM inventario WHERE nombreArticulo = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $itemName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) and $rowcount >= 1) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function createItem($itemName, $ItemDrescription)
{
    $id = generateUserid();

    $sql = "INSERT INTO inventario (idArticulo, nombreArticulo, descripcionArticulo ) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $id, $itemName, $ItemDrescription);
    mysqli_stmt_execute($stmt);

    if (mysqli_errno($GLOBALS['conn']) == 1062) {
        return '1062';
    }

    mysqli_stmt_close($stmt);
    return true;
}


function updateInventory($itemId, $itemQuantity, $operation)
{
    $conn = $GLOBALS['conn'];
    $currentCount = 0;


    $sql = "SELECT cantidadArticulo FROM inventario WHERE idArticulo = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    mysqli_stmt_bind_param($stmt, "s", $itemId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $currentCount = $row['cantidadArticulo'];
    }
    mysqli_stmt_close($stmt);

    if ($operation === "sum") {
        $newCount = $currentCount + $itemQuantity;
    } elseif ($operation === "subtract") {
        $newCount = $currentCount - $itemQuantity;
        if ($newCount < 0) {
            return 0;
        }
    } else {
        die("Operación no válida: " . htmlspecialchars($operation));
    }

    $sql = "UPDATE inventario SET cantidadArticulo = ? WHERE idArticulo = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("is", $newCount, $itemId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function logAdjustment($itemId, $quantity, $operation, $reason)
{
    $ID = generateUserid();
    $userId = $_SESSION['idUsuario'];

    $conn = $GLOBALS['conn'];
    $adjustmentAmount = ($operation === 'subtract') ? -$quantity : $quantity;

    $sql = "INSERT INTO ajustes_inventario (idAjuste, idArticulo, cantidadAjuste, razonAjuste, fechaHoraAjuste, idUsuario) VALUES (?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssiss", $ID, $itemId, $adjustmentAmount, $reason, $userId);
    $result = $stmt->execute();

    if (!$result) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();

    return $result;
}

function deleteItem($itemId)
{
    $conn = $GLOBALS['conn'];

    $sql = "DELETE FROM inventario WHERE idArticulo = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Error al preparar la consulta en deleteItem: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $itemId);

    if (!mysqli_stmt_execute($stmt)) {
        $errorCode = mysqli_stmt_errno($stmt);
        mysqli_stmt_close($stmt);

        if ($errorCode == 1451) {
            // Error 1451: Cannot delete or update a parent row: a foreign key constraint fails
            return 'El articulo posee movimientos, por favor contacte un administrador.';
        } else {
            return 'Error al ejecutar la consulta en deleteItem: ' . mysqli_stmt_error($stmt);
        }
    }

    // Verificar las filas afectadas antes de cerrar el statement
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($affectedRows > 0) {
        return 'Artículo eliminado correctamente';
    } else {
        return 'Artículo no encontrado';
    }
}

