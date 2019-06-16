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

Class Forum
{
    private static $id;
	private static $title;
    private static $description;
	private static $url;
    

	public function __construct($id, $title, $description, $url)
	{
        self::$id = strip_tags(real_escape_string($id));
        self::$title = strip_tags(real_escape_string($title));
		self::$description = strip_tags(real_escape_string($description));
        self::$url = strip_tags(real_escape_string($url));        
	}

	public static function AddForumCategory()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$title) && !empty(self::$description) && !empty(self::$url))
			{
                $qFC= query("SELECT * FROM site_forums_category WHERE url='".self::$url."'");
                if(num_rows($qFC)==0){
                    global $context;

                    query("INSERT INTO site_forums_category SET 
                    title = '" . self::$title . "',
                    description = '". self::$description ."',
                    url = '" . self::$url . "'");

                    echo 'Add';
                }else{
                    echo 'errorURL';
                }
			}
		}
	}
    
    public static function UpdateForumCategory()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$id) && !empty(self::$title) && !empty(self::$description) && !empty(self::$url))
			{
                $qFC= query("SELECT * FROM site_forums_category WHERE url='".self::$url."'");
                if(num_rows($qFC)==0){
                    global $context;

                    query("UPDATE site_forums_category SET 
                    title = '" . self::$title . "',
                    description = '". self::$description ."',
                    url = '" . self::$url . "' WHERE id='".self::$id."'");

                    echo 'up';
                }else{
                    $FC= fetch_assoc($qFC);
                    if($FC['id']==self::$id){
                        global $context;

                        query("UPDATE site_forums_category SET 
                        title = '" . self::$title . "',
                        description = '". self::$description ."',
                        url = '" . self::$url . "' WHERE id='".self::$id."'");
                        
                        echo 'up';
                    }else{
                        echo 'errorURL';
                    }
                }
			}
		}
	}

    public static function DeleteForumCategory()
	{		
		if(!empty(self::$id))
		{
			$q = query("SELECT * FROM site_forums_category WHERE id = '" . self::$id . "'");
			if(num_rows($q) !== 0)
			{
                $r = fetch_assoc($q);
                
                $qT= query("SELECT * FROM site_forums_topics WHERE id_forums_category = '" . self::$id . "'");
                if(num_rows($qT)!==0){
                    while($t = fetch_assoc($qT)){
                        query("DELETE FROM site_forums_comments WHERE id_topic = '" . $t['id'] . "'");
                        $key = sha1(md5('topic'.$t['id']));
                        query("DELETE FROM site_data_emails WHERE keyPr = '" . $key . "'");
                    }
                    query("DELETE FROM site_forums_topics WHERE id_forums_category = '" . self::$id . "'");
                }
                
				query("DELETE FROM site_forums_category WHERE id = '" . self::$id . "'");
                
				echo 'Categoria borrada con &eacute;xito.';
			}
			else
				echo 'La categoria no existe.';
		}else{
            echo'No hay parametros';
        }
	}
}