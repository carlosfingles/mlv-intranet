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

if($_POST['address'] != '' && $_POST['address']!='No hay usuarios' && $_POST['subject']!='' && $_POST['content']!=''){
    $Address = $email['corNot'];
    $Address .=','. $_POST['address'];
    $subject = $_POST['subject'];
    $emailContent = $_POST['content'];
    $emailContent .= '<hr/>
                    <b>Enviado por:</b> <a href="'.$site['url'].'profile/'.$user['username'].'" target="_blank" style="text-decoration:none;">' . $user['username'] . '</a>
                    <br/>
                    <small>'.$site['title'].' | <b>Newsletter</b></small>';

    $rest='<div class="alert alert-success" role="alert">
                Newsletter enviado con exito.
            </div>';

    SendMailer($Address, $Address, $subject, $emailContent, $rest, 'true');
}else{
    echo'<div class="alert alert-danger" role="alert">
            No puedes dejar campos vacios.
        </div>';
}