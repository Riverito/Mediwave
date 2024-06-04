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


    $klein->respond('POST', '/update', function () {
        require(INCLUDES_DIR . '/users/update.php');
    });


    $klein->respond('POST', '/delete', function () {
        require(INCLUDES_DIR . '/users/delete.php');
    });

    ######################### inventory  #########################

    $klein->respond('GET', '/itemsTable', function () {
        require(INCLUDES_DIR . '/inventory/itemsTable.php');
    });

    $klein->respond('GET', '/adjustmentTable', function () {
        require(INCLUDES_DIR . '/inventory/ajustmentsTable.php');
    });

    $klein->respond('POST', '/createItem', function () {
        require(INCLUDES_DIR . '/inventory/createItem.php');
    });


    $klein->respond('POST', '/deleteItem', function () {
        require(INCLUDES_DIR . '/inventory/deleteItem.php');
    });

    $klein->respond('POST', '/ajustments', function () {
        require(INCLUDES_DIR . '/inventory/ajustments.php');
    });

    ######################### Medic System  #########################

    $klein->respond('GET', '/patientsTable', function () {
        require(INCLUDES_DIR . '/medic/patientsTable.php');
    });


    $klein->respond('POST', '/createPatient', function () {
        require(INCLUDES_DIR . '/medic/Createpatient.php');
    });


    $klein->respond('GET', '', function ()  use ($klein) {
        if (session_status() === PHP_SESSION_NONE or !isset($_SESSION['idUsuario'])) {
            $klein->response()->header('Location', '/');
        }
        include(LAYOUTS_DIR . '/dashboard/users.php');
    });
});

$klein->respond('GET', '/inventory', function () {
    require(LAYOUTS_DIR . '/dashboard/inventory.php');
});

$klein->respond('GET', '/medic', function () {
    require(LAYOUTS_DIR . '/dashboard/medic.php');
});


/******************* Dashboard *******************/



$klein->dispatch();
