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
	private static $var1;
    private static $var2;
	private static $var3;
    
    public function __construct($var1, $var2, $var3)
	{
		self::$var1 = strip_tags(real_escape_string($var1));
        self::$var2 = strip_tags(real_escape_string($var2));
		self::$var3 = strip_tags(htmlentities($var3));
	}
    
    public static function AddTopic()
    {
        if(isset($_SESSION['isLogged']))
        {
            if(!empty(self::$var1) && !empty(self::$var2) && !empty(self::$var3))
            {
                global $context;

                query("INSERT INTO site_forums_topics SET 
                date = '" . time() . "',
                author = '".$context['user']['id']."',
                title = '" . self::$var2 . "',
                description = '" . self::$var3 . "',
                id_forums_category = '" .self::$var1. "'");
                $key = sha1(md5('topic'.insert_id()));
                query("INSERT INTO site_data_emails SET id_user = '" . $_SESSION['isLogged'] . "', type = 'topic', keyPr = '" . $key . "' ");

                echo 'add';
            }else
                echo 'No puedes dejar este campo vacio.';
        }
    }
    
    public static function EditTopic()
    {
        if(isset($_SESSION['isLogged']))
        {
            if(!empty(self::$var1) && !empty(self::$var2) && !empty(self::$var3))
            {
                global $context;

                query("UPDATE site_forums_topics SET 
                date = '" . time() . "',
                title = '" . self::$var2 . "',
                description = '" . self::$var3 . "' WHERE id = '" .self::$var1. "'");
                echo 'up';
            }else
                echo 'No puedes dejar este campo vacio.';
        }
    }
    
    public static function DeleteTopic()
    {
        if(isset($_SESSION['isLogged']))
        {
            if(!empty(self::$var1))
            {
                $q = query("SELECT * FROM site_forums_topics WHERE id = '" . self::$var1 . "'");
                if(num_rows($q) !== 0)
                {
                    query("DELETE FROM site_forums_topics WHERE id = '" . self::$var1 . "'");
                    query("DELETE FROM site_forums_comments WHERE id_topic = '" . self::$var1 . "'");
                    $key = sha1(md5('topic'.self::$var1));
                    query("DELETE FROM site_data_emails WHERE keyPr = '" . $key . "'");

                    echo 'Tema borrado con &eacute;xito.';
                }
                else
                    echo 'El Tema no existe.';
            }else{
                echo'No hay parametros';
            }
        }
    }
    
    public static function NewComment()
	{
		global $site, $user;

		if(isset(self::$var1))
		{
			$newsdata = query("SELECT * FROM site_forums_topics WHERE id = '".self::$var1."'");
			if(isset($_SESSION['isLogged']))
			{
				if(num_rows($newsdata) > 0)
				{
					if(!empty(self::$var3))
					{
						query("INSERT INTO site_forums_comments SET id_topic = '".self::$var1."', id_author = '" . $_SESSION['isLogged'] . "', comment = '" . self::$var3 . "', time = '" . time() . "'");
                        
                        $key = sha1(md5('topic'.self::$var1));
                        $q = query("SELECT * FROM site_data_emails WHERE keyPr = '" . $key . "' AND id_user = '" . $_SESSION['isLogged'] . "'");
                        
                        if(num_rows($q)==0){
                            query("INSERT INTO site_data_emails SET id_user = '" . $_SESSION['isLogged'] . "', type = 'topic', keyPr = '" . $key . "' ");
                        }
                        
                        $name='';
                        $Address='';
                        
                        $qR = query("SELECT * FROM site_data_emails WHERE keyPr = '" . $key . "' AND type = 'topic'");
                        
                        if(num_rows($qR)!==0){
                            while($rD=fetch_assoc($qR)){
                                $qU=query("SELECT * FROM site_users WHERE id='".$rD['id_user']."' LIMIT 1");
                                if(num_rows($qU)!==0){
                                    $r=fetch_assoc($qU);
                                    if($r['id']!=$_SESSION['isLogged']){
                                        $name=$name.''.$r['name'].' '.$r['lastname']. ',';
                                        $Address=$Address.''.$r['email'].',';
                                    }
                                }
                            }
                            $topic= fetch_assoc($newsdata);
                            
                            $fCDat= query("SELECT * FROM site_forums_category WHERE id='".$topic['id_forums_category']."'");
                            $fC= fetch_assoc($fCDat);
                            
                            $subject='Nuevo Comentario en el tema: '.$topic['title'];
                            
                            $emailContent = '<h2><b>'.$subject.'</b></h2>
                                            <p>El usuario <a style="text-decoration:none;" target="_blank" href="'.$site['url'].'profile/'.$user['username'].'"><b>'.$user['username'].'</b></a> comento en el tema:</p>
                                           <div style="background-color:#f8f9fa; border-radius: 4px;widht:100%;border:1px solid #a5a5a5;padding:10px;">'.stripslashes(htmlspecialchars_decode(self::$var3)).'</div>
                                            <br/>
                                            <div style="border-radius:4px;background-color: #17a2b8;width: 200px;padding: 10px;" align="center">
                                                <a target="_blank" href="'.$site['url'].'forum/'.$fC['url'].'/'.self::$var1.'" style="text-decoration: none; color:#fff">Ir al tema</a>
                                            </div>
                                            <br/>
                                            <div style="border-radius:4px;background-color: #b81717;width: 200px;padding: 10px;" align="center">
                                                <a target="_blank" href="'.$site['url'].'cancelSusTopic?key='.$key.'" style="text-decoration: none; color:#fff">Cancelar notificaciones para este tema</a>
                                            </div>';
                            if($Address!=''){
                                SendMailer($Address, $name, $subject, $emailContent, '','false');
                            }
                            
                        }
                        
						echo 'add';
					}
					else
						echo 'No puedes dejar esp&aacute;cios en blanco.';
				}
				else
					echo 'Est&aacute; intentando enviar un comentario hacia una noticia inexistente.';
			}
			else
				echo 'Debes iniciar sesi&oacute;n para poder dejar un comentario.';
		}
		else
			echo 'Error en el servidor, no se ha podido enviar el comentario.';
	}
    
    public static function DeleteComment()
    {
        if(isset($_SESSION['isLogged']))
        {
            if(!empty(self::$var1))
            {
                $q = query("SELECT * FROM site_forums_comments WHERE id = '" . self::$var1 . "'");
                if(num_rows($q) !== 0)
                {
                    query("DELETE FROM site_forums_comments WHERE id = '" . self::$var1 . "'");

                    echo 'Comentario borrado con &eacute;xito.';
                }
                else
                    echo 'El comentario no existe.';
            }else{
                echo'No hay parametros';
            }
        }
    }
}