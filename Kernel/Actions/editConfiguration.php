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

require('./Class/Class.Users.php');

$users = new Users($_POST['edit_email'],  $_POST['edit_password'], $_POST['edit_repeatpass'], $_POST['edit_actualpass'], null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
$users->EditConfiguration();