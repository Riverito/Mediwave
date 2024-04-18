<?php
require_once 'functions.inc.php';
if (isset($_POST["submit"])) {
    $userId = $_POST["uid"];
    deleteUser($userId);
}

