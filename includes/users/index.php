<?php
$conn = $GLOBALS['conn'];
$sql1 = "SELECT * FROM roles";
$result1 = mysqli_query($conn, $sql1);
$row_roles = mysqli_fetch_all($result1, MYSQLI_ASSOC);

$sql2 = "SELECT * FROM users";
$result2 = mysqli_query($conn, $sql2);

$usuarios = array();

while ($row2 = mysqli_fetch_array($result2)) {
    $cargo = '';
    $user = '<tr>' .
        '<td>' . $row2["usersName"] . '</td>' .
        '<td>' . $row2["userApellido"] . '</td>' .
        '<td>' . $row2["userCd"] . '</td>' .
        '<td>' . $row2["userEmail"] . '</td>' .
        '<td>';
    foreach ($row_roles as $row1) {
        if ($row1['role_id'] == $row2["userRol"]) {
            $user .= $row1['role_name'];
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
}

echo json_encode($usuarios);
