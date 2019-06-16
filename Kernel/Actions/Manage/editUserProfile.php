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

require('./Clases/Class.User.php');

$wtpp='0';
$tlg='0';
$nets= $_POST['reg_net1'] . '-/*S*/-' . $_POST['reg_net2'] . '-/*S*/-' . $_POST['reg_net3'];
if($_POST['reg_wtpp']=='true'){
    $wtpp='1';
}
if($_POST['reg_tlg']=='true'){
    $tlg='1';
}

new User($_POST['id'], $_POST['reg_name'], $_POST['reg_lastname'], null, null, null, $_POST['reg_birthdate'], $_POST['reg_CI'], $_POST['reg_profession'], $_POST['reg_codephone'], $_POST['reg_phone'], $wtpp, $tlg, $_POST['reg_country'], $_POST['reg_states'], $_POST['reg_city'], $_POST['reg_ideology'], $_POST['reg_social'], $_POST['reg_economic'], $_POST['reg_anotherOrganization'], $nets, $_POST['reg_collabNet'], $_POST['reg_collabVoluntary'], $_POST['reg_collabEvents'], $_POST['reg_collabFunds'], $_POST['reg_collabOther']);
User::UpdateUser();

?>