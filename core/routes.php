<?php

$klein = new \Klein\Klein();

/******************* Basic Routing *******************/
$klein->respond('GET', '/', function () {
    include(LAYOUTS_DIR . '/login.php');
});

$klein->respond('POST', '/auth', function () use ($klein) {
    include(INCLUDES_DIR . '/account/auth.php');
    $klein->response()->header('Location', '/dashboard');
});

$klein->respond('GET', '/logout', function () use ($klein) {
    session_destroy();
    $klein->response()->redirect('/');
});
/******************* Basic Routing *******************/

/******************* Dashboard *******************/

$klein->with('/dashboard', function () use ($klein) {

    $klein->respond('GET', '/index', function () {
        require(INCLUDES_DIR . '/users/index.php');
    });

    $klein->respond('POST', '/create', function () {
        require(INCLUDES_DIR . '/users/create.php');
    });

    $klein->respond('POST', '/delete', function () {
        require(INCLUDES_DIR . '/users/delete.php');
    });

    $klein->respond('GET', '', function ()  use ($klein) {
        if (session_status() === PHP_SESSION_NONE or !isset($_SESSION['idUsuario'])) {
            $klein->response()->header('Location', '/');
        }
        include(LAYOUTS_DIR . '/dashboard/users.php');
    });
});

/******************* Dashboard *******************/


$klein->dispatch();
