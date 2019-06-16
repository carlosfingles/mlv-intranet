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

Class Site
{
	private static $status = null;
	private static $files = array();

	public static function getConfiguration()
	{
		$sql = query("SELECT * FROM site_settings");
		
		while($row = fetch_assoc($sql))
		{
			
			$site[$row['var']] = $row['result'];
		}
		
		return @$site;
	}

	public static function getPermissions()
	{
		$sql = query("SELECT name,rank FROM site_permissions");

		while($row = fetch_assoc($sql))
		{
            $permissions[$row['name']] = $row['rank'];
		}

		return @$permissions;
	}
	
	public static function shortText($msg, $len)
	{
		$result = null;
		
		if(strlen($msg) > $len)
			$result = substr($msg, 0, $len) . '...';
		else
			$result = $msg;
		
		return $result;
	}
    
    public static function shortNum($num){
        $result = null;
		
		if($num!=''){
            $num = $num * 1;
            if($num<1000){
                $result=$num;
            }
            if($num>=1000 && $num<1000000){
                if(strlen($num)==4){
                    $result=substr($num, 0, 1) . '.' . substr($num, -3, 1) . 'K';
                }
                if(strlen($num)==5){
                    $result=substr($num, 0, 2) . '.' . substr($num, -3, 1) . 'K';
                }
                if(strlen($num)==6){
                    $result=substr($num, 0, 3) . '.' . substr($num, -3, 1) . 'K';
                }
            }
            if($num>=1000000 && $num<1000000000){                
                if(strlen($num)==7){
                    $result=substr($num, 0, 1) . '.' . substr($num, -6, 1) . 'M';
                }
                if(strlen($num)==8){
                    $result=substr($num, 0, 2) . '.' . substr($num, -6, 1) . 'M';
                }
                if(strlen($num)==9){
                    $result=substr($num, 0, 3) . '.' . substr($num, -6, 1) . 'M';
                }
            }
            if($num>=1000000000){                
                if(strlen($num)==10){
                    $result=substr($num, 0, 1) . '.' . substr($num, -9, 1) . 'B';
                }
                if(strlen($num)==11){
                    $result=substr($num, 0, 2) . '.' . substr($num, -9, 1) . 'B';
                }
                if(strlen($num)==12){
                    $result=substr($num, 0, 3) . '.' . substr($num, -9, 1) . 'B';
                }
            }
        }else{
            $result = '0';
        }
		
		return $result;
    }

	public static function CleanText($str, $e = "ISO-8859-15")
	{
        
		if(!is_string($str))
			return $str;
		$str = stripslashes(trim($str));
        
		$str = htmlentities($str, ENT_COMPAT, $e, false);
			
		$str = str_replace('&amp;', '&', $str);
        
		$str = iconv($e, "ISO-8859-15//TRANSLIT//IGNORE", $str);
		
		return nl2br($str);
	}
	
	public static function CalculateTime($date)
	{
		$int = Array("segundo", "minuto", "hora", "d&iacute;a", "semana", "mes", "a&ntilde;o");
		$dur = Array(60, 60, 24, 7, 4.35, 12, 12);
		
		if(!is_numeric($date))
			$date = strtotime($date);
		
		$now = time();
		$time = $date;
		
		if($now > $time)
		{
			$dif = $now - $time;
			$str = "Hace";
		}
		else
		{
			$dif = $time - $now;
			$str = "Dentro de";
		}
		
		for($j = 0; $dif >= $dur[$j] && $j < count($dur) - 1; $j++)
			$dif /= $dur[$j];
			
		$dif = round($dif);
		
		if($dif !== 1)
		{
			$int[5] .= "e";
			$int[$j] .= "(s)";
		}
		
		return "$str $dif $int[$j]";
	}

	public static function __($var)
	{
		if(!is_array($var))
			return addslashes($var);
		
		$new_var = array();
		
		foreach($var as $k => $v)
			$new_var[addslashes($k)] = self::__($v);
			
		return $new_var;
	}
}

?>