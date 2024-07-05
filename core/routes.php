<?php

$klein = new \Klein\Klein();

/******************** Basic Routing ********************/
$klein->respond('GET', '/', function () use ($klein) {
    include(LAYOUTS_DIR . '/login.php');
    $access = routeAccessController();
    switch ($access){
        case 3:
            $klein->response()->redirect('/inventory');
        break;
        case 2:
            $klein->response()->redirect('/medical-records');
        break;
        case 1:
            $klein->response()->redirect('/users');
        break;
    }
});

$klein->respond('GET', '/logout', function () use ($klein) {
    unset($_SESSION);
    session_destroy();
    $klein->response()->redirect('/');
});

$klein->respond('GET', '/ac', function () {
    include(INCLUDES_DIR . '/account/routesac.php');
});

$klein->respond('POST', '/auth', function () {
    include(INCLUDES_DIR . '/account/auth.php');
});

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
        if( routeAccessController() === 1){
            include(LAYOUTS_DIR . '/dashboard/users.php');
        }else{
            $klein->response()->redirect('/');
        }
        
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

    $klein->respond('GET', '', function () use ($klein) {
        $access = routeAccessController();
        if( $access === 3 or $access === 1){
            require(LAYOUTS_DIR . '/dashboard/inventory.php');
        }else{
            $klein->response()->redirect('/');
        }
    });
});

######################### Medical Records  #########################

$klein->with('/medical-records', function () use ($klein) {

    $klein->respond('GET', '/index', function () {
        require(INCLUDES_DIR . '/medic/patientsTable.php');
    });

    $klein->respond('GET', '/view', function () {
        require(INCLUDES_DIR . '/medic/ViewMR.php');
    });

    $klein->respond('POST', '/create', function () {
        require(INCLUDES_DIR . '/medic/Createpatient.php');
    });

    $klein->respond('POST', '/assign', function () {
        require(INCLUDES_DIR . '/medic/MedicalRecordCreate.php');
    });

    $klein->respond('POST', '/delete', function () {
        require(INCLUDES_DIR . '/medic/deletePacient.php');
    });
    
    $klein->with('/adjustments', function () use ($klein) {
        $klein->respond('POST', '/create', function () {
            require(INCLUDES_DIR . '/inventory/adjustments.php');
        });
        $klein->respond('GET', '', function () {
            require(INCLUDES_DIR . '/inventory/adjustmentsTable.php');
        });
    });

    $klein->respond('GET', '', function () use ($klein)  {
        $access = routeAccessController();
        if( $access === 2 or $access === 1){
            require(LAYOUTS_DIR . '/dashboard/medic.php');
        }else{
            $klein->response()->redirect('/');
        }
        
    });
});

/******************* Dashboard *******************/



$klein->dispatch();
