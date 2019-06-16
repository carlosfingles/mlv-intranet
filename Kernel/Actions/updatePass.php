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

$pass = strip_tags(real_escape_string($_POST['pass']));
$repass = strip_tags(real_escape_string($_POST['repass']));
$id= $_POST['id_user'];

if($repass == $pass && $repass !='' && $pass !='')
{
    $qT = query("SELECT * FROM site_users WHERE id = '" . $id . "' LIMIT 1");
    $rT = fetch_assoc($qT);
    
    query("UPDATE site_users SET password = '" . sha1(md5($pass)) . "' WHERE id = '" . $id . "'");
    
    query("DELETE FROM site_data_emails WHERE id_user = '" . $id . "' AND type = 'forgotPass'");

    $subject='Clave Modificada';
    $name=$rT['name'].' '.$rT['lastname'];
    $emailContent = '<h2><b>Clave Modificada</b></h2>
                <p >Estimado '.$name.',
                <br/>
                <br/>
                Tu contrase&ntilde;a fue actualizada, si desconoces de este cambio comunicate con nosotros.</p>';

    $Address=$rT['email'];

    SendMailer($Address, $name, $subject, $emailContent, '','false');
    
    echo"true<!----><div class='alert alert-success m-0' role='alert'><center>Contrase&ntilde;a cambiada con &eacute;xito, ahora puede <a href='#' class='alert-link' data-toggle='modal' data-target='#loginModal'>Ingresar</a>.</center></div>";
}else{
    echo 'false<!----><div class="alert alert-danger m-0" role="alert"><center>Las contrase&ntilde;as no coinciden.</center></div>';
}