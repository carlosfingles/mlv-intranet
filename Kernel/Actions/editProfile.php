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
    

	public function __construct($name, $lastname, $username, $password, $email, $birthdate, $curp, $profession, $codephone, $phone, $whatsapp, $telegram, $country, $state, $city, $ideology, $socialTest, $economicTest, $anotherOrganization, $networkings, $sharingInNetworks, $voluntary, $participateInEvents, $fundsAndDonations, $anotherWayToCollaborate)
	{
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

	public static function Send()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$name) && !empty(self::$lastname) &&  !empty(self::$curp) &&  !empty(self::$birthdate) &&  !empty(self::$profession) &&  !empty(self::$phone) &&  !empty(self::$ideology) &&  !empty(self::$networkings))
			{
                if(self::$country != 'nulo' && self::$state != 'nulo'){

                    global $context, $user, $email;

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
                     WHERE id='".$context['user']['id']."' ");
                    
                    $datCountry = query("SELECT * FROM countries WHERE id = '" . self::$country . "' LIMIT 1");
                    $country = fetch_assoc($datCountry);

                    $datState = query("SELECT * FROM states WHERE id='" . self::$state . "' LIMIT 1");
                    $state = fetch_assoc($datState);
                    
                    $Address=$email['corNot'];
                    $ename=$email['corNot'];
                    $subject='El usuario '.$user['username'].' cambio sus datos';
                    $emailContent='<h2><b>'.$subject.'</b></h2>
                        </br>
                        <p ><b>Nombre</b>: ' . self::$name . '<br/>
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
}

$wtpp='0';
$tlg='0';
$nets= $_POST['reg_net1'] . '-/*S*/-' . $_POST['reg_net2'] . '-/*S*/-' . $_POST['reg_net3'];
if($_POST['reg_wtpp']=='true'){
    $wtpp='1';
}
if($_POST['reg_tlg']=='true'){
    $tlg='1';
}

new Post($_POST['reg_name'], $_POST['reg_lastname'], null, null, null, $_POST['reg_birthdate'], $_POST['reg_CI'], $_POST['reg_profession'], $_POST['reg_codephone'], $_POST['reg_phone'], $wtpp, $tlg, $_POST['reg_country'], $_POST['reg_states'], $_POST['reg_city'], $_POST['reg_ideology'], $_POST['reg_social'], $_POST['reg_economic'], $_POST['reg_anotherOrganization'], $nets, $_POST['reg_collabNet'], $_POST['reg_collabVoluntary'], $_POST['reg_collabEvents'], $_POST['reg_collabFunds'], $_POST['reg_collabOther']);
Post::Send();

?>