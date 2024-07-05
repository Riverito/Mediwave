<?php
require_once (ABSPATH .'core/functions.php');
$routeac = routeAccessController();

$response = array(
    'url' => ''
);

switch ($routeac){
    case 3:
        $response['url'] = '/inventory';
    break;
    case 2:
        $response['url'] = '/medical-records';
    break;
    case 1:
        $response['url'] = '/users';
    break;
}

echo json_encode($response);
