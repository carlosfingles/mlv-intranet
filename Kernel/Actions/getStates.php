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

if($country!="nulo"){    
    $qU = query("SELECT * FROM site_users WHERE id = '" . $context['user']['id'] . "' LIMIT 1");
    $rU = fetch_assoc($qU);
    
    if($rU['rank']=='2' && isset($_POST['index']) && $_POST['index']=='true'){
        $q = query("SELECT * FROM states WHERE id = '" . $rU['state'] . "'");
    }else{
        $q = query("SELECT * FROM states WHERE country_id = '" . $country . "'");
        echo '<option value="nulo">Elegir Estado/Provincia</option>';
    }
    
    while($r = fetch_assoc($q)){
        
        if(isset($_POST['index']) && $_POST['index']=='true'){

            $countryDat= query ("SELECT * FROM site_users WHERE state ='" . $r['id'] . "' ");

            if(num_rows($countryDat)!==0){
                if($rU['state']==$r['id']){
                    echo '<option selected value="'.$r['id'].'">'. $r['name'] .'</option>';
                }else{
                    echo '<option value="'.$r['id'].'">'. $r['name'] .'</option>';
                }
            }
        }else{
            if($rU['state']==$r['id']){
                echo '<option selected value="'.$r['id'].'">'. $r['name'] .'</option>';
            }else{
                echo '<option value="'.$r['id'].'">'. $r['name'] .'</option>';
            }
        }
    }
}else{
    echo '<option value="nulo">Elegir Estado/Provincia</option>';
}


?>