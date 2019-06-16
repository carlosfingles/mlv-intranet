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

require('../../../Init.php');

Class ConfigMail
{
    private static $smtp;
    private static $user;
    private static $pass;
    private static $encryp;
    private static $port;
    private static $bool;

	public function __construct($smtp, $user, $pass, $encryp, $port, $bool)
	{
        self::$smtp = strip_tags(htmlentities(real_escape_string($smtp)));
        self::$user = strip_tags(htmlentities(real_escape_string($user)));
        self::$pass = strip_tags(htmlentities(real_escape_string($pass)));
		self::$encryp = strip_tags(htmlentities(real_escape_string($encryp)));
		self::$port = strip_tags(htmlentities(real_escape_string($port)));
        self::$bool = strip_tags(htmlentities(real_escape_string($bool)));
	}
    
    public static function ConfMail()
	{
		global $context;

		if(!empty(self::$smtp) && !empty(self::$user) && !empty(self::$pass)  && !empty(self::$encryp)  && !empty(self::$port))
		{   
            MySQL::Query("UPDATE site_emails SET smtpServer= '" . self::$smtp . "', user = '" . self::$user . "', pass = '" . self::$pass . "', encryp = '" . self::$encryp . "', port = '" . self::$port . "', corNot = '" . self::$bool . "' WHERE id='mail'");
            
			echo "Datos actualizados.";
		}else{
            echo "No puedes dejar campos vacios.";
        }
	}
    
    public static function ConfMailBool()
	{
		global $context;

		if(!empty(self::$bool))
		{
			query("UPDATE site_emails SET correoBool= '" . self::$bool . "' WHERE id='mail'");
            if(self::$bool=='true'){
                echo'Notificaciones por correo electr&oacute;nico activado.';
            }
            if(self::$bool=='false'){
                echo'Notificaciones por correo electr&oacute;nico desactivado.';
            }
        }
	}
    
}
?>