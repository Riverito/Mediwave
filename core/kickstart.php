<?php
define('DEBUG', 0);
include 'core/functions.php';
include 'vendor/autoload.php';

if( DEBUG == 1 ){
    error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
    ini_set('display_errors', TRUE);
}
define( 'ABSPATH', dirname( __DIR__ ) . '/' );
define('INCLUDES_DIR', ABSPATH."includes");
define('LAYOUTS_DIR', ABSPATH."layouts");
