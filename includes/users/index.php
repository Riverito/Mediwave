<?php
$conn = $GLOBALS['conn'];
$sql1 = "SELECT * FROM roles";
$result1 = mysqli_query($conn, $sql1);
$row_roles = mysqli_fetch_all($result1, MYSQLI_ASSOC);

$sql2 = "SELECT * FROM usuarios";
$result2 = mysqli_query($conn, $sql2);

// Contar el número total de usuarios
$total_users = mysqli_num_rows($result2);

$usuarios = array();

// Variable para controlar el índice del usuario actual
$current_index = 0;

while ($row2 = mysqli_fetch_array($result2)) {
    // Omitir el último usuario
    if ($current_index == $total_users - 1) {
        break;
    }

    $user = '<tr>' .
        '<td>' . $row2["nombreUsuario"] . '</td>' .
        '<td>' . $row2["apellidoUsuario"] . '</td>' .
        '<td>' . $row2["cedulaUsuario"] . '</td>' .
        '<td>' . $row2["emailUsuario"] . '</td>' .
        '<td>';
    foreach ($row_roles as $row1) {
        if ($row1['idRol'] == $row2["idRol"]) {
            $user .= $row1['nombreRol'];
            break;
        }
    }
    $user .= '</td>' .
        '<td>' .
        '<button type="button" data-bs-toggle="modal" data-bs-target="#EditUserModal" class="editbtn m-1 btn btn-primary" data-uid="' . $row2["idUsuario"] . '">' .
        '<i class="fa-solid fa-pen-to-square"></i>' .
        '</button>' .
        '<button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="delbtn m-1 btn btn-danger" data-uid="' . $row2["idUsuario"] . '">' .
        '<i class="fa-solid fa-trash"></i>' .
        '</button>' .
        '</td>' .
        '</tr>';

    $usuarios[] = $user;

    $current_index++;
}

echo json_encode($usuarios);
?>
