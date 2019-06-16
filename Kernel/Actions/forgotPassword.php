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

$username = $_POST['username'];

$q = query("SELECT * FROM site_users WHERE username = '$username' OR email = '$username'  ORDER by id DESC LIMIT 1");

if(num_rows($q) != 0)
{
    $r = fetch_assoc($q);

    $key = sha1(md5('forgotPass'.$username));
    
    query("DELETE FROM site_data_emails WHERE id_user = '" . $r['id'] . "' AND type = 'forgotPass'");

    query("INSERT INTO site_data_emails SET id_user = '" . $r['id'] . "', type = 'forgotPass', keyPr = '" . $key . "' ");

    $subject='Restablecer clave';
    
    $name=$r['name'].' '.$r['lastname'];
    $emailContent = '<h2><b>Restablecer clave</b></h2>
                <p >Estimado '.$name.',
                <br/>
                <br/>
                Has click en el boton de abajo para restablecer tu contrase&ntilde;a.</p>
                <br/>
                <div style="border-radius:4px;background-color: #17a2b8;width: 200px;padding: 10px;" align="center">
                    <a target="_blank" href="'.$site['url'].'forgotPassword?key='.$key.'" style="text-decoration: none; color:#fff">Restablecer tu contrase&ntilde;a</a>
                </div>';

    $Address=$r['email'];
    $rest='Se envio un correo electr&oacute;nico a <b>' .$r['email']. '</b>';

    SendMailer($Address, $name, $subject, $emailContent, $rest,'true');

}else{
    echo'nullUserEmail';
}
?>