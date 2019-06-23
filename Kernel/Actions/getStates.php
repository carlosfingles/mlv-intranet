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

$index='false';
if(isset($_POST['index'])){
    $index=$_POST['index'];
}

$users = new Users($_POST['country'], null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
$users->GetStates($index);