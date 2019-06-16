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

$get = $_POST['id_topic'];

Class Post
{
	private static $comment;

	public function __construct($comment)
	{
		self::$comment = strip_tags(htmlentities(real_escape_string($comment)));
	}

	public static function Send()
	{
		global $get, $site, $user;

		if(isset($get))
		{
			$newsdata = query("SELECT * FROM site_forums_topics WHERE id = '$get'");
			if(isset($_SESSION['isLogged']))
			{
				if(num_rows($newsdata) > 0)
				{
					if(!empty(self::$comment))
					{
						query("INSERT INTO site_forums_comments SET id_topic = '$get', id_author = '" . $_SESSION['isLogged'] . "', comment = '" . self::$comment . "', time = '" . time() . "'");
                        
                        $key = sha1(md5('topic'.$get));
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
                                           <div style="background-color:#f8f9fa; border-radius: 4px;widht:100%;border:1px solid #a5a5a5;padding:10px;">'.stripslashes(htmlspecialchars_decode(self::$comment)).'</div>
                                            <br/>
                                            <div style="border-radius:4px;background-color: #17a2b8;width: 200px;padding: 10px;" align="center">
                                                <a target="_blank" href="'.$site['url'].'forum/'.$fC['url'].'/'.$get.'" style="text-decoration: none; color:#fff">Ir al tema</a>
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
}

new Post($_POST['comment']);
Post::Send();

?>