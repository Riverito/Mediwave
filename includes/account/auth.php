<?php

if (isset($_POST["submit"])) {
    $userEmail = $_POST["userEmail"];
    $pwd = $_POST["pwd"]; 

    require_once (ABSPATH .'core/functions.php');

    if (emptyInputLogin($userEmail, $pwd) !== false) {
        header("location: /auth?error=campovacio");
        exit();
    }

    if(LoginUser($userEmail, $pwd)){
        return 'Ha sucedido un error.';
    };
} 