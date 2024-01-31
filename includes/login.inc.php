<?php

if (isset($_POST["submit"])) {
    $userEmail = $_POST["userEmail"];
    $pwd = $_POST["pwd"]; // Corregido el nombre de la variable


    require_once 'functions.inc.php';


    if (emptyInputLogin($userEmail, $pwd) !== false) {
        header("location: ".url()."/login.php?error=campovacio");
        exit();
    }

    LoginUser($conn, $userEmail, $pwd);
} else {
    echo $pwd . 'weno';
    exit();
}
