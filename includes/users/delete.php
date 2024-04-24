<?php
if (isset($_POST["uid"])) {
    $userId = $_POST["uid"];
    deleteUser($userId);
    echo 'Eliminado exitoso.';
}
echo 'Ha ocurrido un error.';
