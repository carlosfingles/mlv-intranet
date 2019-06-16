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

require('../../Init.php');
$country = $_POST['country'];

$qU = query("SELECT * FROM site_users WHERE id = '" . $context['user']['id'] . "' LIMIT 1");
$rU = fetch_assoc($qU);

$q = query("SELECT * FROM countries  ORDER by phonecode ASC");
if($country!="nulo"){
    while($r = fetch_assoc($q)){
        if($r['id']==$country){
            echo '<option selected value="'.$r['phonecode'].'">+('. $r['phonecode'] .')</option>';
        }else{
            echo '<option value="'.$r['phonecode'].'">+('. $r['phonecode'] .')</option>';
        }
    }
}else{
    while($r = fetch_assoc($q)){
            echo '<option value="'.$r['phonecode'].'">+('. $r['phonecode'] .')</option>';
    }
}


?>