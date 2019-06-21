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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ROOT . 'src/PHPMailer/vendor/autoload.php';

require_once(Modules . 'MySQL.php');
new MySQL;

require_once(Modules . 'Site.php');
new Site;

require(ROOT . 'Kernel/Settings.php');
MySQL::Connect($MySQL['HOST'], $MySQL['USER'], $MySQL['PASS'], $MySQL['BASE']);

function query($q = '')
{
	return MySQL::query($q);
}
function fetch_assoc($q = '')
{
	return MySQL::fetch_assoc($q);
}
function num_rows($q = '')
{
	return MySQL::num_rows($q);
}
function real_escape_string($q = '')
{
	return MySQL::real_escape_string($q);
}
function insert_id()
{
	return MySQL::insert_id();
}

$escaped_link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$site = Site::getConfiguration();

$userdata = query("SELECT * FROM site_users WHERE id = '" . @$_SESSION['isLogged'] . "'");
$user = fetch_assoc($userdata);

if(isset($_SESSION['isLogged'])){
    if($user['rank']==0){
        $user['rankname'] = "Postulante";
    }

    if($user['rank']==1){
        $user['rankname'] = "Miembro";
    }

    if($user['rank']==2){
        $user['rankname'] = "Coordinador";
    }

    if($user['rank']>=3){
        $user['rankname'] = "Administrador";
    }
}

$site['permissions'] = Site::getPermissions();

$context = array(
	'user' => array(
		'id' => !isset($_SESSION['isLogged']) ? 0 : $user['id'],
		'name' => !isset($_SESSION['isLogged']) ? 'Visitante' : $user['username'],
		'pass' => !isset($_SESSION['isLogged']) ? null : $user['password'],
		'lastaccess', !isset($_SESSION['isLogged']) ? time() : $user['lastaccess'],
		'ip', !isset($_SESSION['isLogged']) ? IP : $user['ip'],
		'rank' => !isset($_SESSION['isLogged']) ? 0 : $user['rank'],
		'banned', !isset($_SESSION['isLogged']) ? null : $user['bannish']
	),
	'site' => array(
		'title' => $site['title'],
		'slogan' => $site['slogan'],
		'url' => $site['url'],
		'maint' => $site['maint'],
        'keywords' => $site['keywords'],
        'author' => $site['author'],
        'scriptHead' => $site['scriptHead']
	),
	'permissions' => $site['permissions'],
);

if(isset($_SESSION['isLogged']))
	query("UPDATE site_users SET ip = '" . IP . "' WHERE id = '" . $context['user']['id'] . "'");

if(isset($_SESSION['isLogged']) && empty($user['id'])){
    echo"<script>window.location = '".$site['url']."logout.php';</script>";
    die();
}

$datMail = query("SELECT * FROM site_emails WHERE id = 'mail'");
$email = fetch_assoc($datMail);

function SendMailer($emailAddress, $nameAddress, $subject, $emailContent, $rest, $debugError){
    $emailAddress=explode(',', $emailAddress);
    $nameAddress=explode(',', $nameAddress);
    global $email, $site;
    if($email['correoBool']=='true'){
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = $email['smtpServer']; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $email['user']; // SMTP username
            $mail->Password = $email['pass']; // SMTP password
            $mail->SMTPSecure = $email['encryp']; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $email['port']; // TCP port to connect to

            //Recipients
            $mail->setFrom($email['user'], $site['title']);
            
            for($x=0;$x<count($emailAddress); $x++){
                if($emailAddress[$x]!=''){
                    if($nameAddress[$x]!=''){
                        $mail->addAddress($emailAddress[$x], $nameAddress[$x]); // Name is optional
                    }else{
                        $mail->addAddress($emailAddress[$x]); // Name is optional
                    }
                }
            }

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $emailContent;

            $mail->send();
            echo $rest;
        } catch (Exception $e) {
            if($debugError=='true'){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }else{
        if($debugError=='true'){
            echo "Las notificaciones por correo electronico estan desactivadas.";
        }
    }
}

?>
