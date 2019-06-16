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

Class ConfigSite
{
    private static $var1;
    private static $var2;
    private static $var3;
    private static $var4;
    private static $var5;

    public function __construct($var1, $var2, $var3, $var4, $var5)
    {
        self::$var1= strip_tags(htmlentities(real_escape_string($var1)));
        self::$var2= strip_tags(htmlentities(real_escape_string($var2)));
        self::$var3= strip_tags(htmlentities(real_escape_string($var3)));
        self::$var4= strip_tags(htmlentities(real_escape_string($var4)));
        self::$var5= strip_tags(htmlentities(real_escape_string($var5)));
    }
    
    public static function Develop(){
        global $context;
            query("UPDATE site_settings SET result= '" . self::$var1 . "' WHERE var='scriptHead'");

            echo "Head actualizado";
    }
    
    public static function Title()
    {
        global $context;

        if(!empty(self::$var1))
        {
            query("UPDATE site_settings SET result= '" . self::$var1 . "' WHERE var='title'");
            
            echo "T&iacute;tulo actualizado.";
        }else{
            echo'No puedes dejar este campo T&iacute;tulo vacio.';
        }
    }
    
    public static function Url()
	{
		global $context;

		if(!empty(self::$var2))
		{
			query("UPDATE site_settings SET result= '" . self::$var2 . "' WHERE var='url'");
            
			echo "URL actualizado.";
		}else{
            echo'No puedes dejar este campo Url vacio.';
        }
	}
    
    public static function Slogan()
	{
		global $context;

		if(!empty(self::$var3))
		{
			query("UPDATE site_settings SET result= '" . self::$var3 . "' WHERE var='slogan'");
            
			echo "Descripci&oacute;n actualizada.";
		}else{
            echo 'No puedes dejar este campo Descripci&oacute;n vacio.';
        }
	}
    
    public static function Keys()
	{
		global $context;

		if(!empty(self::$var4))
		{
			query("UPDATE site_settings SET result= '" . self::$var4 . "' WHERE var='keywords'");
            
			echo "Palabras Clave actualizadas.";
		}else{
            echo 'No puedes dejar este campo Palabras clave vacio.';
        }
	}
        
    public static function Author()
	{
		global $context;

		if(!empty(self::$var5))
		{
			query("UPDATE site_settings SET result= '" . self::$var5 . "' WHERE var='author'");
            
			echo "Autor actualizadas.";
		}else{
            echo 'No puedes dejar este campo vacio.';
        }
	}
    
    public static function TwitterCardAct()
	{
		global $context;

		if(!empty(self::$var1))
		{
			query("UPDATE site_settings SET result= '" . self::$var1 . "' WHERE var='twitterSeo'");
		      if(self::$var1== 'true'){
                  echo 'Twitter Card activado.';
              }else{
                  echo 'Twitter Card desactivado.';
              }
        }
	}
    
    public static function TwitterCardUser()
	{
		global $context;

		if(!empty(self::$var1))
		{
			query("UPDATE site_settings SET result= '" . self::$var1 . "' WHERE var='twitterUser'");
            echo 'Usuario de Twitter actualizado.';   
        }else{
            echo 'No puede dejar campos vacios.';  
        }
	}
}
?>