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

Class User
{
    private static $id;
	private static $name;
    private static $lastname;
	private static $username;
	private static $password;
    private static $email;
    private static $birthdate;
    private static $curp;
    private static $profession;
    private static $codephone;
    private static $phone;
    private static $whatsapp;
    private static $telegram;
    private static $country;
    private static $state;
    private static $city;
    private static $ideology;
    private static $socialTest;
    private static $economicTest;
    private static $anotherOrganization;
    private static $networkings;
    private static $sharingInNetworks;
    private static $voluntary;
    private static $participateInEvents;
    private static $fundsAndDonations;
    private static $anotherWayToCollaborate;
    

	public function __construct($id, $name, $lastname, $username, $password, $email, $birthdate, $curp, $profession, $codephone, $phone, $whatsapp, $telegram, $country, $state, $city, $ideology, $socialTest, $economicTest, $anotherOrganization, $networkings, $sharingInNetworks, $voluntary, $participateInEvents, $fundsAndDonations, $anotherWayToCollaborate)
	{
        self::$id = strip_tags(real_escape_string($id));
        self::$name = strip_tags(real_escape_string($name));
		self::$lastname = strip_tags(real_escape_string($lastname));
        self::$username = strip_tags(real_escape_string($username));
        self::$password = strip_tags(real_escape_string($password));
        self::$email = strip_tags(real_escape_string($email));
        self::$birthdate = strip_tags(real_escape_string($birthdate));
        self::$curp = strip_tags(real_escape_string($curp));
        self::$profession = strip_tags(real_escape_string($profession));
        self::$codephone = strip_tags(real_escape_string($codephone));
        self::$phone = strip_tags(real_escape_string($phone));
        self::$whatsapp = strip_tags(real_escape_string($whatsapp));
        self::$telegram = strip_tags(real_escape_string($telegram));
        self::$country = strip_tags(real_escape_string($country));
        self::$state = strip_tags(real_escape_string($state));
        self::$city = strip_tags(real_escape_string($city));
        self::$ideology = strip_tags(real_escape_string($ideology));
        self::$socialTest = strip_tags(real_escape_string($socialTest));
        self::$economicTest = strip_tags(real_escape_string($economicTest));
        self::$anotherOrganization = strip_tags(real_escape_string($anotherOrganization));
        self::$networkings = strip_tags(real_escape_string($networkings));
        self::$sharingInNetworks = strip_tags(real_escape_string($sharingInNetworks));
        self::$voluntary = strip_tags(real_escape_string($voluntary));
        self::$participateInEvents = strip_tags(real_escape_string($participateInEvents));
        self::$fundsAndDonations = strip_tags(real_escape_string($fundsAndDonations));
        self::$anotherWayToCollaborate = strip_tags(real_escape_string($anotherWayToCollaborate));
        
	}

	public static function UpdateUser()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$id) && !empty(self::$name) && !empty(self::$lastname) &&  !empty(self::$curp) &&  !empty(self::$birthdate) &&  !empty(self::$profession) &&  !empty(self::$phone) &&  !empty(self::$ideology) &&  !empty(self::$networkings))
			{
                if(self::$country != 'nulo' && self::$state != 'nulo'){

                    global $context, $user, $email;
                    
                    $q=query("SELECT * FROM site_users WHERE id='".self::$id."' LIMIT 1");
                    $r=fetch_assoc($q);

                    query("UPDATE site_users SET 
                    name = '" . self::$name . "',
                    lastname = '" . self::$lastname . "',
                    birthdate = '" . self::$birthdate . "', 
                    curp = '" . self::$curp . "', 
                    profession = '" . self::$profession . "', 
                    codephone = '" . self::$codephone . "', 
                    phone = '" . self::$phone . "', 
                    whatsapp = '" . self::$whatsapp . "', 
                    telegram = '" . self::$telegram . "', 
                    country = '" . self::$country . "', 
                    state = '" . self::$state . "', 
                    city = '" . self::$city . "', 
                    ideology = '" . self::$ideology . "', 
                    socialTest = '" . self::$socialTest . "', 
                    economicTest = '" . self::$economicTest . "', 
                    anotherOrganization = '" . self::$anotherOrganization . "', 
                    networkings = '" . self::$networkings . "', 
                    sharingInNetworks = '" . self::$sharingInNetworks . "', 
                    voluntary = '" . self::$voluntary . "', 
                    participateInEvents = '" . self::$participateInEvents . "', 
                    fundsAndDonations = '" . self::$fundsAndDonations . "', 
                    anotherWayToCollaborate = '" . self::$anotherWayToCollaborate . "'
                     WHERE id='".self::$id."' ");

                    $datCountry = query("SELECT * FROM countries WHERE id = '" . self::$country . "' LIMIT 1");
                    $country = fetch_assoc($datCountry);

                    $datState = query("SELECT * FROM states WHERE id='" . self::$state . "' LIMIT 1");
                    $state = fetch_assoc($datState);

                    $Address=$r['email'].','.$email['corNot'];
                    $ename=$email['corNot'];
                    $subject='El '.$user['rankname'].' '.$user['username'].' cambio los datos de '.$r['username'];
                    $emailContent='<h2><b>'.$subject.'</b></h2>
                        </br>
                        <p ><b>'.$user['rankname'].'</b>: <a href="'.$context['site']['url'].'profile/'.$user['username'].'" target="_blank" style="text-decoration:none;">' . $user['username'] . '</a><br/>
                        <b>Nombre</b>: ' . self::$name . '<br/>
                        <b>Apellido</b>: ' . self::$lastname . '<br/>
                        <b>Cumpleaños</b>: ' . self::$birthdate . '<br/>
                        <b>CI</b>: ' . self::$curp . '<br/>
                        <b>Profesion</b>: ' . self::$profession . '<br/>
                        <b>Tlf</b>: +(' . self::$codephone . ')' . self::$phone . '<br/>
                        <b>Whatsapp</b>: ' . self::$whatsapp . '<br/>
                        <b>Telegram</b>: ' . self::$telegram . '<br/>
                        <b>Pais</b>: ' . $country['name'] . '<br/>
                        <b>Estado</b>: ' . $state['name'] . '<br/>
                        <b>Ciudad</b>: ' . self::$city . '<br/>
                        <b>Ideologia</b>: ' . self::$ideology . '<br/>
                        <b>Social</b>: ' . self::$socialTest . '<br/>
                        <b>Economico</b>: ' . self::$economicTest . '<br/>
                        <b>Otra organizacion</b>: ' . self::$anotherOrganization . '<br/>
                        <b>Redes sociales</b>: ' . self::$networkings . '<br/>
                        <b>Compartir en redes</b>: ' . self::$sharingInNetworks . '<br/>
                        <b>Voluntario</b>: ' . self::$voluntary . '<br/>
                        <b>Participar en eventos</b>: ' . self::$participateInEvents . '<br/>
                        <b>Pondos y Donativos</b>: ' . self::$fundsAndDonations . '<br/>
                        <b>Otra manera de Colaborar</b>: ' . self::$anotherWayToCollaborate . '</p>';
                        SendMailer($Address, $ename, $subject, $emailContent, '','false');
                            
                    echo '<div class="alert alert-success" role="alert">Perfil guardado con exito.</div>';
                }else
                    echo '<div class="alert alert-danger" role="alert">No puedes dejar espacios en blanco.</div>';
			}else
                echo '<div class="alert alert-danger" role="alert">No puedes dejar espacios en blanco.</div>';
		}
		else
            echo '<div class="alert alert-danger" role="alert">Error en el servidor, no se han podido guardar los cambios.</div>';
	}
    
    public static function UpdateUserCog()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$id) && !empty(self::$email) && !empty(self::$username))
			{

                global $context, $user, $email;
                
                $q=query("SELECT * FROM site_users WHERE id='".self::$id."' LIMIT 1");
                $r=fetch_assoc($q);
                    
                query("UPDATE site_users SET 
                email = '" . self::$email . "',
                username = '". self::$username ."'
                 WHERE id='".self::$id."' ");
                
                $Address=$r['email'].','.$email['corNot'];
                $ename=$email['corNot'];
                $subject='El '.$user['rankname'].' '.$user['username'].' ha actualizado los ajustes de la cuenta de '.$r['username'];
                $emailContent='<h2><b>'.$subject.'</b></h2>
                    </br>
                    <p ><b>'.$user['rankname'].'</b>: <a href="'.$context['site']['url'].'profile/'.$user['username'].'" target="_blank" style="text-decoration:none;">' . $user['username'] . '</a><br/>
                    <b>Email</b>: fue modificado de "'.$r['email'].'" a "' . self::$email . '".<br/>
                    <b>Usuario</b>: fue modificado de "'.$r['username'].'" a "'. self::$username .'".</p>';
                    SendMailer($Address, $ename, $subject, $emailContent, '','false');
                            
                echo '<div class="alert alert-success" role="alert">Ajustes guardados con exito.</div>';
			}else
                echo '<div class="alert alert-danger" role="alert">No puedes dejar espacios en blanco.</div>';
		}
		else
            echo '<div class="alert alert-danger" role="alert">Error en el servidor, no se han podido guardar los cambios.</div>';
	}
    
    public static function UpdateUserRank(){
        if(isset($_SESSION['isLogged']))
		{
            if(empty(self::$name)){
                self::$name='0';
            }
			if(!empty(self::$id))
			{

                global $context, $user, $email;

                query("UPDATE site_users SET 
                rank = '". self::$name ."'
                 WHERE id='".self::$id."' ");
                
                $q= query("SELECT * FROM site_users WHERE id='".self::$id."' ");
                
                if(num_rows($q)!==0){
                    $r=fetch_assoc($q);
                    $rankname='';
                    
                    if($r['rank']==0){
                        $rankname = "Postulante";
                    }
                    if($r['rank']==1){
                        $rankname = "Miembro";
                    }
                    if($r['rank']==2){
                        $rankname = "Coordinador";
                    }
                    if($r['rank']>=3){
                        $rankname = "Administrador";
                    }
                    
                    $Address=$r['email'];
                    $ename=$r['name'] . " " . $r['lastname'];
                    $subject='Tu rango en '.$context['site']['title'] .' ha cambiado';
                    $emailContent='<h2><b>Tu rango en '.$context['site']['title'] .' ha cambiado</b></h2>
                                <p >Estimado '.$ename .',
                                    <br/>
                                    <br/>
                                    Tu rango en el sitio de <a href="'.$context['site']['url'] .'" target="_blank">'.$context['site']['title'] .'</a> ha cambiado a <b>'.$rankname.'</b>.
                                    <br/>
                                    Atentamente,
                                    <br/>
                                    Departamento IT, Movimiento Libertario de Venezuela.</p>';
                    SendMailer($Address, $ename, $subject, $emailContent, '','false');
                    
                    $Address=$email['corNot'];
                    $ename=$email['corNot'];
                    $subject='El '.$user['rankname'].' '.$user['username'].' ha cambiado el rango del usuario '.$r['username'];
                    $emailContent='<h2><b>'.$subject.'</b></h2>
                        </br>
                        <p ><b>'.$user['rankname'].'</b>: <a href="'.$context['site']['url'].'profile/'.$user['username'].'" target="_blank" style="text-decoration:none;">' . $user['username'] . '</a><br/>
                        <b>Rango</b>: ' . $rankname . '<br/>
                        <b>Usuario</b>: '. $r['username'] .'</p>';
                        SendMailer($Address, $ename, $subject, $emailContent, '','false');
                }
                            
                echo 'Rango guardado con exito.';
			}else
                echo 'No puedes dejar espacios en blanco.';
		}
		else
            echo 'Error en el servidor, no se han podido guardar los cambios.';
    }
    
    public static function DeleteUser()
	{
        global $id, $user, $email;
		
		if(isset($id))
		{
			$q = query("SELECT * FROM site_users WHERE id = '" . self::$id . "'");
			if(num_rows($q) !== 0)
			{
                $r = fetch_assoc($q);
                
                $qT= query("SELECT * FROM site_forums_topics WHERE author = '" . self::$id . "'");
                if(num_rows($qT)!==0){
                    while($t = fetch_assoc($qT)){
                        query("DELETE FROM site_forums_comments WHERE id_topic = '" . $t['id'] . "'");
                    }
                    query("DELETE FROM site_forums_topics WHERE author = '" . self::$id . "'");
                }
                query("DELETE FROM site_forums_comments WHERE id_author = '" . self::$id . "'");
                
                query("DELETE FROM site_users WHERE id = '" . self::$id . "'");
                
                if($r['avatar']!='avatar.jpg'){
                    unlink('../../../images/imgperfil/'.$r['avatar']);
                }
                if($r['cover']!='cover.jpg'){
                    unlink('../../../images/imgcover/'.$r['cover']);
                }
                $Address=$email['corNot'];
                $ename=$email['corNot'];
                $subject='El '.$user['rankname'].' '.$user['username'].' ha eliminado la cuenta de '.$r['username'];
                $emailContent='<h2><b>'.$subject.'</b></h2>
                    </br>
                    <p ><b>'.$user['rankname'].'</b>: <a href="'.$context['site']['url'].'profile/'.$user['username'].'" target="_blank" style="text-decoration:none;">' . $user['username'] . '</a><br/>
                    <b>Usuario</b>: '. $r['username'] .'<br/>
                    <b>Opci&oacute;n</b>: Eliminado<br/></p>';
                SendMailer($Address, $ename, $subject, $emailContent, '','false');
                
				echo 'Usuario borrado con &eacute;xito.';
			}
			else
				echo 'El usuario no existe.';
		}else{
            echo'No hay parametros';
        }
	}
}