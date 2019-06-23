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

require('./Class/Class.ConfigMail.php');

$e_mail = new ConfigMail($_POST['mail_server'], $_POST['mail_user'], $_POST['mail_pass'], $_POST['mail_encryp'], $_POST['mail_port'], $_POST['mail_corNot']);
$e_mail->ConfMail();