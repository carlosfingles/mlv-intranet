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

error_reporting(0);

require('../../Init.php');

$u = $site['favicon'];

Class Get
{
	private static $file;

	public function __construct($u)
	{
		self::$file = real_escape_string($u);
	}

	public static function Take()
	{
		global $u;
		
        if($u!='favicon.ico')
        {
            if (!unlink($u))
            {
                echo"El icono <b>".$_GET['fichero']."</b> no existe o ya fue eliminada.;no";
            }else{
                $q = query("SELECT * FROM site_settings WHERE  var= 'favicon'");
                $r = fetch_assoc($q);
                
                if($u == $r['result']){
                    query ("UPDATE site_settings SET result= 'favicon.ico' WHERE var= 'favicon' ");
                }
                
                echo "El icono <b>".$u."</b> ha sido eliminada.;si";
            }
        }
        else{

            echo"El icono <b>".$u."</b> no puede ser eliminada.;no";

        }
	}
}

new Get($u);
Get::Take();

?>