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

$q = query("SELECT * FROM site_users WHERE id= '".$context['user']['id']."'");
$r = fetch_assoc($q);

$u = $r['avatar'];

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
		
        if($u!='avatar.jpg')
        {
            if (!unlink($u))
            {
                echo"La imagen <b>".$u."</b> no existe o ya fue eliminada.;no";
            }else{
                query("UPDATE site_users SET avatar= 'avatar.jpg' WHERE avatar= '".$u."' ");
                echo "La imagen <b>".$u."</b> ha sido eliminada.;si";
            }
        }
        else{

            echo"La imagen <b>".$u."</b> no puede ser eliminada.;no";

        }
	}
}

new Get($u);
Get::Take();

?>