<?php
if (isset($_POST["uid"])) {
    $error = '';

    $userId = $_POST["uid"];
    deleteUser($userId);
    $error =  deleteUser($userId);

    var_dump($error);
}
