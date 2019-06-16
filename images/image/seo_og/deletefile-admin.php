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

require('../../../Init.php');

$u = $site['ogImg'];

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
		
        if($u!='ImgSeo.jpg')
        {
            if (!unlink($u))
            {
                echo"La imagen <b>".$u."</b> no existe o ya fue eliminada.;no";
            }else{
                
                $q = query("SELECT * FROM site_settings WHERE  var= 'ogImg'");
                $r = fetch_assoc($q);
                
                if($u == $r['result']){
                    query ("UPDATE site_settings SET result= 'ImgSeo.jpg' WHERE var= 'ogImg' ");
                }
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