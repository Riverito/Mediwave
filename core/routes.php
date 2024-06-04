<?php

$klein = new \Klein\Klein();

/******************** Basic Routing ********************/
$klein->respond('GET', '/', function () {
    include(LAYOUTS_DIR . '/login.php');
});
$klein->respond('GET', '/logout', function () use ($klein) {
    unset($_SESSION);
    session_destroy();
    $klein->response()->redirect('/');
});

$klein->respond('POST', '/auth', function () use ($klein) {
    include(INCLUDES_DIR . '/account/auth.php');
    $klein->response()->header('Location', '/users');
});


/******************** Basic Routing *******************/

/******************* Users *******************/
$klein->with('/users', function () use ($klein) {

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

    $klein->respond('GET', '', function ()  use ($klein) {
        var_dump($_SESSION);
        var_dump(checkSession());
        include(LAYOUTS_DIR . '/dashboard/users.php');
    });
});

######################### Inventory  #########################

$klein->with('/inventory', function () use ($klein) {

    $klein->respond('GET', '/index', function () {
        require(INCLUDES_DIR . '/inventory/itemsTable.php');
    });

    $klein->respond('POST', '/create', function () {
        require(INCLUDES_DIR . '/inventory/createItem.php');
    });

    $klein->respond('POST', '/delete', function () {
        require(INCLUDES_DIR . '/inventory/deleteItem.php');
    });
    
    $klein->with('/adjustments', function () use ($klein) {
        $klein->respond('POST', '/create', function () {
            require(INCLUDES_DIR . '/inventory/adjustments.php');
        });
        $klein->respond('GET', '', function () {
            require(INCLUDES_DIR . '/inventory/adjustmentsTable.php');
        });
    });

    $klein->respond('GET', '', function () {
        require(LAYOUTS_DIR . '/dashboard/inventory.php');
    });
});

######################### Medical Records  #########################

$klein->with('/medical-records', function () use ($klein) {

    $klein->respond('GET', '/index', function () {
        require(INCLUDES_DIR . '/medic/patientsTable.php');
    });

    $klein->respond('POST', '/create', function () {
        require(INCLUDES_DIR . '/medic/Createpatient.php');
    });

    $klein->respond('POST', '/delete', function () {
        require(INCLUDES_DIR . '/inventory/deleteItem.php');
    });
    
    $klein->with('/adjustments', function () use ($klein) {
        $klein->respond('POST', '/create', function () {
            require(INCLUDES_DIR . '/inventory/adjustments.php');
        });
        $klein->respond('GET', '', function () {
            require(INCLUDES_DIR . '/inventory/adjustmentsTable.php');
        });
    });

    $klein->respond('GET', '', function () {
        require(LAYOUTS_DIR . '/dashboard/medic.php');
    });
});

/******************* Dashboard *******************/


$klein->dispatch();
