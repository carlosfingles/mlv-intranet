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

require('./Class/Class.User.php');

$userReg = str_replace(' ', '', $_POST['reg_username']);
$user = new User($_POST['id'], null, null, $userReg, null, $_POST['reg_email'], null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
$user->UpdateUserCog();