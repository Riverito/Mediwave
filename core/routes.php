<?php

$klein = new \Klein\Klein();

/******************* Basic Routing *******************/
$klein->respond('GET', '/', function () {
    include(LAYOUTS_DIR . '/login.php');
});

$klein->respond('POST', '/auth', function () {
    include(INCLUDES_DIR . '/account/auth.php');
});
/******************* Basic Routing *******************/

/******************* Dashboard USERS *******************/

$klein->respond('GET', '/dashboard', function () use ($klein) {

    if (session_status() === PHP_SESSION_NONE) {
        $klein->response()->header('Location', '/');
    }

    include(LAYOUTS_DIR . '/dashboard/users.php');
});

$klein->respond('GET', '/dashboard/index', function () {
    include(INCLUDES_DIR . '/users/index.php');
});

$klein->respond('POST', '/dashboard/create', function () {
    include(INCLUDES_DIR . '/users/create.php');
});
/******************* Dashboard USERS *******************/


$klein->dispatch();
