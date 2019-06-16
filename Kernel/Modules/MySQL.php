<?php
/**
 * Class MySQL v1.0 - Libreria para conexion con bses de datos mysql
 * 
 * @license GNU GPL V3
 * @author Carlos Zambrano (carlosfingles)
 *         Facebook : http://facebook.com/carlosfingles
 *         Twitter : @carlosfingles
 *         Instagram : @carlosfingles
 */

Class MySQL
{
	private static $q = null;
	private static $sql = null;
	public static $last_query = "";
	public static $last_resource = null;
    
    public $connect=null;
	
	public static function Connect($host = '', $user = '', $pass = '', $db = '')
	{
        global $connect;
		$connect = mysqli_connect($host, $user, $pass, $db);

        if (mysqli_connect_errno()) {
            printf("Error al conectar: %s\n", mysqli_connect_error());
            exit();
        }
        
		return $connect;
	}
	
	public static function query($q = '')
	{
		global $connect;
		$sent=$q ."";
        
		$sql = mysqli_query($connect," ".$sent." ") or die ("Error mysql: ".mysqli_error());
        
        
        
		return $sql;
	}
	
	public static function fetch_assoc($row)
	{
		global $connect;
        if($row)
		  return mysqli_fetch_assoc($row);
	}
	
	public static function num_rows($q = '')
	{
		global $connect;
        
        if($q)
		  return mysqli_num_rows($q);
	}
    
    public static function real_escape_string($st)
	{
		global $connect;
        
		return mysqli_real_escape_string($connect, $st);
	}
    
    public static function insert_id()
	{
		global $connect;
        
		return mysqli_insert_id($connect);
	}
}

?>