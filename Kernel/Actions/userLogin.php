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

Class Post
{
    private static $email;
    private static $pass;
    private static $remember;
    public function __construct($email, $password, $remember)
    {
        global $connect;
            self::$email = strip_tags(real_escape_string($email));
            self::$pass = strip_tags(real_escape_string($password));
            self::$remember = strip_tags(real_escape_string($remember));
    }

    public static function Send()
    {
        if(!empty(self::$email) AND !empty(self::$pass))
        {
            $get_data = query("SELECT * FROM site_users WHERE email='". self::$email ."' OR username='". self::$email ."'");

            if(num_rows($get_data))
            {
                $data = fetch_assoc($get_data);

                if(sha1(md5(self::$pass)) == $data['password'])
                {
                    if($data['bannish'] !== "1")
                    {
                        global $context;
                        $_SESSION['isLogged'] = $data['id'];
                        query("UPDATE site_users SET lastaccess = '" . time() . "' WHERE id = '" . $data['id'] ."'");

                        if(self::$remember=='true'){
                            echo'remOn,';
                        }else{
                            echo'remOff,';
                        }
                        echo 'logueado';
                  }
                    else
                        echo 'El usuario <b>' . self::$email . '</b> est&aacute; baneado.,baneado';
                }
                else
                    echo 'Contrase&ntilde;a incorrecta.,passInValid';
            }
            else
                echo 'El usuario <b>(' . self::$email . ')</b> no existe.,userNot';
        }
        else
            echo 'No puedes dejar este campo en blanco.,inputsNull';
    }
}
 
new Post($_POST['email'], $_POST['password'], $_POST['rememberMe']);
Post::Send();
 
?>
