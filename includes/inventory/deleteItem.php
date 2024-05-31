<?php
if (isset($_POST["uid"])) {
    $userId = $_POST["uid"];
    var_dump($userId);
    deleteItem($itemId);
    echo 'Eliminado exitoso.';
}

