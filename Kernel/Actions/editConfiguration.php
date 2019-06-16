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

$get = @$_GET['article'];

Class Post
{
	private static $email;
	private static $password;
	private static $repeatpass;
	private static $actualpass;

	public function __construct($email, $password, $repeatpass, $actualpass)
	{
		self::$email = strip_tags(real_escape_string($email));
		self::$password = strip_tags(real_escape_string($password));
		self::$repeatpass = strip_tags(real_escape_string($repeatpass));
		self::$actualpass = strip_tags(real_escape_string($actualpass));
	}

	public static function Send()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$email) && !empty(self::$actualpass))
			{
				if(self::$repeatpass == self::$password)
				{
					$getdata = query("SELECT * FROM site_users WHERE id = '" . $_SESSION['isLogged'] . "'");
					$getd = fetch_assoc($getdata);

					if(sha1(md5(self::$actualpass)) == $getd['password'])
					{
                        global $context, $user, $email;
						if(!empty(self::$password) && !empty(self::$repeatpass)){
							query("UPDATE site_users SET email = '" . self::$email . "', password = '" . sha1(md5(self::$password)) . "' WHERE id = '" . $_SESSION['isLogged'] . "'");
                            $Address=$getd['email'];
                            $ename=$getd['name'] . " " . $getd['lastname'];
                            $subject='Haz actualizado los ajustes de tu cuenta';
                            $emailContent='<h2><b>Haz actualizado los ajustes de tu cuenta</b></h2>
                                        </br>
                                        <p >Estimado '.$ename .',
                                            <br/>
                                            <br/>
                                            Haz cambiado tu correo electronico por '.self::$email.', tambien detectamos que tu contrase&ntilde;a fue modificada.
                                            <br/>
                                            Si no haz realizado estos cambios por favor puedes responder a este email o enviarnos un mensaje a: <a href="mailto:it@mlv-intranet.org" target="_blank">it@mlv-intranet.org</a>, de lo contrario ignora este mensaje.
                                            <br/>
                                            Atentamente,
                                            <br/>
                                            Departamento IT, Movimiento Libertario de Venezuela.</p>';
                            SendMailer($Address, $ename, $subject, $emailContent, '','false');
						}else{
							query("UPDATE site_users SET email = '" . self::$email . "' WHERE id = '" . $_SESSION['isLogged'] . "'");
                            $Address=$getd['email'];
                            $ename=$getd['name'] . " " . $getd['lastname'];
                            $subject='Haz actualizado tu correo electronico';
                            $emailContent='<h2><b>Haz actualizado tu correo electronico</b></h2>
                                        </br>
                                        <p >Estimado '.$ename .',
                                            <br/>
                                            <br/>
                                            Haz cambiado tu correo electronico por '.self::$email.'.
                                            <br/>
                                            Si no haz realizado estos cambios por favor puedes responder a este email o enviarnos un mensaje a: <a href="mailto:it@mlv-intranet.org" target="_blank">it@mlv-intranet.org</a>, de lo contrario ignora este mensaje.
                                            <br/>
                                            Atentamente,
                                            <br/>
                                            Departamento IT, Movimiento Libertario de Venezuela.</p>';
                            SendMailer($Address, $ename, $subject, $emailContent, '','false');
                        }
                        $Address=$email['corNot'];
                        $ename=$email['corNot'];
                        $subject='El usuario '.$user['username'].' ha actualizado los ajustes de su cuenta';
                        $emailContent='<h2><b>'.$subject.'</b></h2>
                            </br>
                            <p ><b>Email</b>: ' . self::$email . '<br/>
                            <b>Password</b>: ******</p>';
                            SendMailer($Address, $ename, $subject, $emailContent, '','false');
                        
						echo '<div class="alert alert-success" role="alert"><center>Cambios guardados con &eacute;xito.</center></div>';
					}
					else
						echo '<div class="alert alert-danger" role="alert"><center>Tu contrase&ntilde;a actual no coincide.</center></div>';
				}
				else
					echo '<div class="alert alert-danger" role="alert"><center>Las contrase&ntilde;as no coinciden.</center></div>';
			}
			else
				echo '<div class="alert alert-danger" role="alert"><center>No puedes dejar espacios en blanco.</center></div>';
		}
		else
			echo '<div class="alert alert-danger" role="alert"><center>Error en el servidor, no se han podido guardar los cambios.</center></div>';
	}

}

new Post($_POST['edit_email'],  $_POST['edit_password'], $_POST['edit_repeatpass'], $_POST['edit_actualpass']);
Post::Send();

?>