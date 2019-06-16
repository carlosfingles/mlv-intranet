<?php
/**
 * MLV intranet v2.0 - Web oficial del intranet del MLV
 * 
 * @link https://github.com/carlosfingles/mlv-intranet
 * @license GNU GPL V3
 * @author Carlos Zambrano (carlosfingles)
 *         Facebook : http://facebook.com/carlosfingles
 *         Twitter : @carlosfingles
 *         Instagram : @carlosfingles
 */

define('PIXELARIO', true);
define('IP', $_SERVER['REMOTE_ADDR']);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__) . DS);

define('Kernel', ROOT . 'Kernel' . DS);
define('Modules', Kernel . 'Modules' . DS);
define('Templates', Kernel . 'Templates' . DS);

session_start();

require(Kernel . 'Functions.php');

$_POST = Site::__($_POST);
$_GET = Site::__($_GET);
$_REQUEST = Site::__($_REQUEST);
$_SERVER = Site::__($_SERVER);
$_COOKIE = Site::__($_COOKIE);

?>