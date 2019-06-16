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

$u = @$_GET['id'];

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
		
        if($u!='cover.jpg')
        {
            if (!unlink($u))
            {
                echo" La imagen: ".$u." no existe o ya fue eliminada.";
            }else{
                query ("UPDATE site_users SET cover= 'cover.jpg' WHERE cover= '" . self::$file . "' ");
        
                echo "La imagen: ".$u." ha sido eliminada.";
            }
        }
        else{

            echo"La imagen: ".$u." no puede ser eliminada.";

        }
	}
}

new Get($u);
Get::Take();

?>