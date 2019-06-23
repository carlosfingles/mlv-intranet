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

Class Users
{
	private static $var1;
    private static $var2;
	private static $var3;
	private static $var4;
    private static $var5;
    private static $var6;
    private static $var7;
    private static $var8;
    private static $var9;
    private static $var10;
    private static $var11;
    private static $var12;
    private static $var13;
    private static $var14;
    private static $var15;
    private static $var16;
    private static $var17;
    private static $var18;
    private static $var19;
    private static $var20;
    private static $var21;
    private static $var22;
    private static $var23;
    private static $var24;
    private static $var25;
    
    public function __construct($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var11, $var12, $var13, $var14, $var15, $var16, $var17, $var18, $var19, $var20, $var21, $var22, $var23, $var24, $var25)
	{
		self::$var1 = strip_tags(real_escape_string($var1));
        self::$var2 = strip_tags(real_escape_string($var2));
		self::$var3 = strip_tags(real_escape_string($var3));
        self::$var4 = strip_tags(real_escape_string($var4));
        self::$var5 = strip_tags(real_escape_string($var5));
        self::$var6 = strip_tags(real_escape_string($var6));
        self::$var7 = strip_tags(real_escape_string($var7));
        self::$var8 = strip_tags(real_escape_string($var8));
		self::$var9 = strip_tags(real_escape_string($var9));
        self::$var10 = strip_tags(real_escape_string($var10));
        self::$var11 = strip_tags(real_escape_string($var11));
        self::$var12 = strip_tags(real_escape_string($var12));
        self::$var13 = strip_tags(real_escape_string($var13));
        self::$var14 = strip_tags(real_escape_string($var14));
        self::$var15 = strip_tags(real_escape_string($var15));
        self::$var16 = strip_tags(real_escape_string($var16));
        self::$var17 = strip_tags(real_escape_string($var17));
        self::$var18 = strip_tags(real_escape_string($var18));
        self::$var19 = strip_tags(real_escape_string($var19));
        self::$var20 = strip_tags(real_escape_string($var20));
        self::$var21 = strip_tags(real_escape_string($var21));
        self::$var22 = strip_tags(real_escape_string($var22));
        self::$var23 = strip_tags(real_escape_string($var23));
        self::$var24 = strip_tags(real_escape_string($var24));
        self::$var25 = strip_tags(real_escape_string($var25));
	}

	public static function Register()
	{
        global $site;
		if(!isset($_SESSION['isLogged']))
		{
			if(!empty(self::$var1) && !empty(self::$var2) && !empty(self::$var3) &&  !empty(self::$var4) &&  !empty(self::$var7) &&  !empty(self::$var5) &&  !empty(self::$var6) &&  !empty(self::$var8) &&  !empty(self::$var10) &&  !empty(self::$var16) &&  !empty(self::$var20))
			{
                if(self::$var13 != 'nulo' && self::$var14 != 'nulo'){
                    $r = query("SELECT * FROM site_users WHERE email = '" . self::$var5 . "'");

                    if(num_rows($r) == 0)
                    {
                        $ru = query("SELECT * FROM site_users WHERE username = '" . self::$var3 . "'");

                        if(num_rows($ru) == 0)
                        {
                            global $context, $site, $email;

                            query("INSERT INTO site_users SET 
                            lastaccess = '" . time() . "',
                            dateAdmission = '".date('Y-m-d')."',
                            name = '" . self::$var1 . "',
                            lastname = '" . self::$var2 . "',
                            username = '" . self::$var3 . "', 
                            password = '" . sha1(md5(self::$var4)) . "', 
                            email = '" . self::$var5 . "', 
                            birthdate = '" . self::$var6 . "', 
                            curp = '" . self::$var7 . "', 
                            profession = '" . self::$var8 . "', 
                            codephone = '" . self::$var9 . "', 
                            phone = '" . self::$var10 . "', 
                            whatsapp = '" . self::$var11 . "', 
                            telegram = '" . self::$var12 . "', 
                            country = '" . self::$var13 . "', 
                            state = '" . self::$var14 . "', 
                            city = '" . self::$var15 . "', 
                            ideology = '" . self::$var16 . "', 
                            socialTest = '" . self::$var17 . "', 
                            economicTest = '" . self::$var18 . "', 
                            anotherOrganization = '" . self::$var19 . "', 
                            networkings = '" . self::$var20 . "', 
                            sharingInNetworks = '" . self::$var21 . "', 
                            voluntary = '" . self::$var22. "', 
                            participateInEvents = '" . self::$var23 . "', 
                            fundsAndDonations = '" . self::$var24 . "', 
                            anotherWayToCollaborate = '" . self::$var25 . "',
                            rank = '0' ");
                            
                            $_SESSION['isLogged'] = insert_id();
                            
                                
                            $datCountry = query("SELECT * FROM countries WHERE id = '" . self::$var13 . "' LIMIT 1");
                            $country = fetch_assoc($datCountry);
                                    
                            $datState = query("SELECT * FROM states WHERE id='" . self::$var14 . "' LIMIT 1");
                            $state = fetch_assoc($datState);
                            
                            $Address=self::$var5;
                            $ename=self::$var1 . " " . self::$var2;
                            $subject='Bienvenido al MLV';
                            $emailContent='<h2><b>Bienvenido al MLV</b></h2>
                                            </br>
                                            <p >Estimado '.$ename .',
                                            <br/>
                                            <br/>
                                            Agradecemos tu interes por unirte a la red libertaria mas grande de Venezuela.
                                            <br/>
                                            Puedes modificar tus datos en todo momento en nuestra pagina <a href="'.$site['url'].'" target="_blank">'.$site['url'].'</a>
                                            <br/>
                                            Pronto seras contactado por un coordinador para verificar tus datos. La inscripcion no sera efectiva hasta realizada esta operacion.
                                            <br/>
                                            En caso de problemas con la pagina, o de tener cualquier pregunta, puedes responder a este email o enviarnos uno nuevo a: <a href="mailto:it@mlv-intranet.org" target="_blank">it@mlv-intranet.org</a>
                                            <br/>
                                            Atentamente,
                                            <br/>
                                            Departamento IT, Movimiento Libertario de Venezuela.</p>';
                            SendMailer($Address, $ename, $subject, $emailContent, 'correcto','false');
                            
                            $Address=$email['corNot'];
                            $ename=$email['corNot'];
                            $subject='Un nuevo miembro se ha inscrito en el MLV';
                            $emailContent='<h2><b>Un nuevo miembro se ha inscrito en el MLV:</b></h2>
                                    </br>
                                    <p ><b>Fecha de admision</b>: '.date('Y-m-d').'<br/>
                                    <b>Nombre</b>: ' . self::$var1 . '<br/>
                                    <b>Apellido</b>: ' . self::$var2 . '<br/>
                                    <b>Usuario</b>: ' . self::$var3 . '<br/>
                                    <b>Correo</b>: ' . self::$var5 . '<br/>
                                    <b>Cumpleaños</b>: ' . self::$var6 . '<br/>
                                    <b>CI</b>: ' . self::$var7 . '<br/>
                                    <b>Profesion</b>: ' . self::$var8 . '<br/>
                                    <b>Tlf</b>: +(' . self::$var9 . ')' . self::$var10 . '<br/>
                                    <b>Whatsapp</b>: ' . self::$var11 . '<br/>
                                    <b>Telegram</b>: ' . self::$var12 . '<br/>
                                    <b>Pais</b>: ' . $country['name'] . '<br/>
                                    <b>Estado</b>: ' . $state['name'] . '<br/>
                                    <b>Ciudad</b>: ' . self::$var15 . '<br/>
                                    <b>Ideologia</b>: ' . self::$var16 . '<br/>
                                    <b>Social</b>: ' . self::$var17 . '<br/>
                                    <b>Economico</b>: ' . self::$var18 . '<br/>
                                    <b>Otra organizacion</b>: ' . self::$var19 . '<br/>
                                    <b>Redes sociales</b>: ' . self::$var20 . '<br/>
                                    <b>Compartir en redes</b>: ' . self::$var21 . '<br/>
                                    <b>Voluntario</b>: ' . self::$var22. '<br/>
                                    <b>Participar en eventos</b>: ' . self::$var23 . '<br/>
                                    <b>Pondos y Donativos</b>: ' . self::$var24 . '<br/>
                                    <b>Otra manera de Colaborar</b>: ' . self::$var25 . '</p>';
                                    SendMailer($Address, $ename, $subject, $emailContent, 'correcto','false');
                            
                            echo 'null,registrado';
                            
                        }else
                            echo 'El Usuario ' . self::$var3 . ' ya fue usado.,errorUser';
                    }
                    else
                        echo 'El correo ' . self::$var5 . ' ya fue usado.,errorEmail';
                }else
                    echo 'No puedes dejar estos campos vacio.,inputsNull';
			}else
                echo 'No puedes dejar este campo vacio.,inputsNull';
		}
		else{
			echo 'Ya est&aacute;s logeado.,loginTrue,null,null,null,null';
        }
	}
    
    public static function Login()
    {
        if(!empty(self::$var1) AND !empty(self::$var2))
        {
            $get_data = query("SELECT * FROM site_users WHERE email='". self::$var1 ."' OR username='". self::$var1 ."'");

            if(num_rows($get_data))
            {
                $data = fetch_assoc($get_data);

                if(sha1(md5(self::$var2)) == $data['password'])
                {
                    if($data['bannish'] !== "1")
                    {
                        $_SESSION['isLogged'] = $data['id'];
                        query("UPDATE site_users SET lastaccess = '" . time() . "' WHERE id = '" . $data['id'] ."'");

                        if(self::$var3=='true'){
                            echo'remOn,';
                        }else{
                            echo'remOff,';
                        }
                        echo 'logueado';
                    }
                    else
                        echo 'El usuario <b>' . self::$var1 . '</b> est&aacute; baneado.,baneado';
                }
                else
                    echo 'Contrase&ntilde;a incorrecta.,passInValid';
            }
            else
                echo 'El usuario <b>(' . self::$var1 . ')</b> no existe.,userNot';
        }
        else
            echo 'No puedes dejar este campo en blanco.,inputsNull';
    }
    
    public static function EditProfile()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$var1) && !empty(self::$var2) &&  !empty(self::$var7) &&  !empty(self::$var6) &&  !empty(self::$var8) &&  !empty(self::$var10) &&  !empty(self::$var16) &&  !empty(self::$var20))
			{
                if(self::$var13 != 'nulo' && self::$var14 != 'nulo'){

                    global $context, $user, $email;

                    query("UPDATE site_users SET 
                    name = '" . self::$var1 . "',
                    lastname = '" . self::$var2 . "',
                    birthdate = '" . self::$var6 . "', 
                    curp = '" . self::$var7 . "', 
                    profession = '" . self::$var8 . "', 
                    codephone = '" . self::$var9 . "', 
                    phone = '" . self::$var10 . "', 
                    whatsapp = '" . self::$var11 . "', 
                    telegram = '" . self::$var12 . "', 
                    country = '" . self::$var13 . "', 
                    state = '" . self::$var14 . "', 
                    city = '" . self::$var15 . "', 
                    ideology = '" . self::$var16 . "', 
                    socialTest = '" . self::$var17 . "', 
                    economicTest = '" . self::$var18 . "', 
                    anotherOrganization = '" . self::$var19 . "', 
                    networkings = '" . self::$var20 . "', 
                    sharingInNetworks = '" . self::$var21 . "', 
                    voluntary = '" . self::$var22 . "', 
                    participateInEvents = '" . self::$var23 . "', 
                    fundsAndDonations = '" . self::$var24 . "', 
                    anotherWayToCollaborate = '" . self::$var25 . "'
                     WHERE id='".$context['user']['id']."' ");
                    
                    $datCountry = query("SELECT * FROM countries WHERE id = '" . self::$var13 . "' LIMIT 1");
                    $country = fetch_assoc($datCountry);

                    $datState = query("SELECT * FROM states WHERE id='" . self::$var14 . "' LIMIT 1");
                    $state = fetch_assoc($datState);
                    
                    $Address=$email['corNot'];
                    $ename=$email['corNot'];
                    $subject='El usuario '.$user['username'].' cambio sus datos';
                    $emailContent='<h2><b>'.$subject.'</b></h2>
                        </br>
                        <p ><b>Nombre</b>: ' . self::$var1 . '<br/>
                        <b>Apellido</b>: ' . self::$var2 . '<br/>
                        <b>Cumpleaños</b>: ' . self::$var6 . '<br/>
                        <b>CI</b>: ' . self::$var7 . '<br/>
                        <b>Profesion</b>: ' . self::$var8 . '<br/>
                        <b>Tlf</b>: +(' . self::$var9 . ')' . self::$var10 . '<br/>
                        <b>Whatsapp</b>: ' . self::$var11 . '<br/>
                        <b>Telegram</b>: ' . self::$var12 . '<br/>
                        <b>Pais</b>: ' . $country['name'] . '<br/>
                        <b>Estado</b>: ' . $state['name'] . '<br/>
                        <b>Ciudad</b>: ' . self::$var15 . '<br/>
                        <b>Ideologia</b>: ' . self::$var16 . '<br/>
                        <b>Social</b>: ' . self::$var17 . '<br/>
                        <b>Economico</b>: ' . self::$var18 . '<br/>
                        <b>Otra organizacion</b>: ' . self::$var19 . '<br/>
                        <b>Redes sociales</b>: ' . self::$var20 . '<br/>
                        <b>Compartir en redes</b>: ' . self::$var21 . '<br/>
                        <b>Voluntario</b>: ' . self::$var22 . '<br/>
                        <b>Participar en eventos</b>: ' . self::$var23 . '<br/>
                        <b>Pondos y Donativos</b>: ' . self::$var24 . '<br/>
                        <b>Otra manera de Colaborar</b>: ' . self::$var25 . '</p>';
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
    
    public static function EditConfiguration()
	{
		if(isset($_SESSION['isLogged']))
		{
			if(!empty(self::$var1) && !empty(self::$var4))
			{
				if(self::$var3 == self::$var2)
				{
					$getdata = query("SELECT * FROM site_users WHERE id = '" . $_SESSION['isLogged'] . "'");
					$getd = fetch_assoc($getdata);

					if(sha1(md5(self::$var4)) == $getd['password'])
					{
                        global $context, $user, $email;
						if(!empty(self::$var2) && !empty(self::$var3)){
							query("UPDATE site_users SET email = '" . self::$var1 . "', password = '" . sha1(md5(self::$var2)) . "' WHERE id = '" . $_SESSION['isLogged'] . "'");
                            $Address=$getd['email'];
                            $ename=$getd['name'] . " " . $getd['lastname'];
                            $subject='Haz actualizado los ajustes de tu cuenta';
                            $emailContent='<h2><b>Haz actualizado los ajustes de tu cuenta</b></h2>
                                        </br>
                                        <p >Estimado '.$ename .',
                                            <br/>
                                            <br/>
                                            Haz cambiado tu correo electronico por '.self::$var1.', tambien detectamos que tu contrase&ntilde;a fue modificada.
                                            <br/>
                                            Si no haz realizado estos cambios por favor puedes responder a este email o enviarnos un mensaje a: <a href="mailto:it@mlv-intranet.org" target="_blank">it@mlv-intranet.org</a>, de lo contrario ignora este mensaje.
                                            <br/>
                                            Atentamente,
                                            <br/>
                                            Departamento IT, Movimiento Libertario de Venezuela.</p>';
                            SendMailer($Address, $ename, $subject, $emailContent, '','false');
						}else{
							query("UPDATE site_users SET email = '" . self::$var1 . "' WHERE id = '" . $_SESSION['isLogged'] . "'");
                            $Address=$getd['email'];
                            $ename=$getd['name'] . " " . $getd['lastname'];
                            $subject='Haz actualizado tu correo electronico';
                            $emailContent='<h2><b>Haz actualizado tu correo electronico</b></h2>
                                        </br>
                                        <p >Estimado '.$ename .',
                                            <br/>
                                            <br/>
                                            Haz cambiado tu correo electronico por '.self::$var1.'.
                                            <br/>
                                            Si no haz realizado estos cambios por favor puedes responder a este email o enviarnos un mensaje a: <a href="mailto:it@mlv-intranet.org" target="_blank">it@mlv-intranet.org</a>, de lo contrario ignora este mensaje.
                                            <br/>
                                            Atentamente,
                                            <br/>
                                            Departamento IT, Movimiento Libertario de Venezuela.</p>';
                            SendMailer($Address, $ename, $subject, $emailContent, '','false');
                        }
                        $Address=$email['corNot'];
                        $ename=$email['corNot'];
                        $subject='El usuario '.$user['username'].' ha actualizado los ajustes de su cuenta';
                        $emailContent='<h2><b>'.$subject.'</b></h2>
                            </br>
                            <p ><b>Email</b>: ' . self::$var1 . '<br/>
                            <b>Password</b>: ******</p>';
                            SendMailer($Address, $ename, $subject, $emailContent, '','false');
                        
						echo '<div class="alert alert-success" role="alert"><center>Cambios guardados con &eacute;xito.</center></div>';
					}
					else
						echo '<div class="alert alert-danger" role="alert"><center>Tu contrase&ntilde;a actual no coincide.</center></div>';
				}
				else
					echo '<div class="alert alert-danger" role="alert"><center>Las contrase&ntilde;as no coinciden.</center></div>';
			}
			else
				echo '<div class="alert alert-danger" role="alert"><center>No puedes dejar espacios en blanco.</center></div>';
		}
		else
			echo '<div class="alert alert-danger" role="alert"><center>Error en el servidor, no se han podido guardar los cambios.</center></div>';
	}
    
    public static function ForgotPassword()
    {
        if(!empty(self::$var1)){
            global $site;

            $q = query("SELECT * FROM site_users WHERE username = '".self::$var1."' OR email = '".self::$var1."'  ORDER by id DESC LIMIT 1");

            if(num_rows($q) != 0)
            {
                $r = fetch_assoc($q);

                $key = sha1(md5('forgotPass'.self::$var1));

                query("DELETE FROM site_data_emails WHERE id_user = '" . $r['id'] . "' AND type = 'forgotPass'");

                query("INSERT INTO site_data_emails SET id_user = '" . $r['id'] . "', type = 'forgotPass', keyPr = '" . $key . "' ");

                $subject='Restablecer clave';

                $name=$r['name'].' '.$r['lastname'];
                $emailContent = '<h2><b>Restablecer clave</b></h2>
                            <p >Estimado '.$name.',
                            <br/>
                            <br/>
                            Has click en el boton de abajo para restablecer tu contrase&ntilde;a.</p>
                            <br/>
                            <div style="border-radius:4px;background-color: #17a2b8;width: 200px;padding: 10px;" align="center">
                                <a target="_blank" href="'.$site['url'].'forgotPassword?key='.$key.'" style="text-decoration: none; color:#fff">Restablecer tu contrase&ntilde;a</a>
                            </div>';

                $Address=$r['email'];
                $rest='Se envio un correo electr&oacute;nico a <b>' .$r['email']. '</b>';

                SendMailer($Address, $name, $subject, $emailContent, $rest,'true');

            }else{
                echo'nullUserEmail';
            }
        }
    }
    
    public static function UpdatePass()
    {
        if(!empty(self::$var1) && !empty(self::$var2) && !empty(self::$var3)){

            if(self::$var3 == self::$var2 && self::$var3 !='' && self::$var2 !='')
            {
                global $email;
                $qT = query("SELECT * FROM site_users WHERE id = '" . self::$var1 . "' LIMIT 1");
                $rT = fetch_assoc($qT);

                query("UPDATE site_users SET password = '" . sha1(md5(self::$var2)) . "' WHERE id = '" . self::$var1 . "'");

                query("DELETE FROM site_data_emails WHERE id_user = '" . self::$var1 . "' AND type = 'forgotPass'");

                $subject='Clave Modificada';
                $name=$rT['name'].' '.$rT['lastname'];
                $emailContent = '<h2><b>Clave Modificada</b></h2>
                            <p >Estimado '.$name.',
                            <br/>
                            <br/>
                            Tu contrase&ntilde;a fue actualizada, si desconoces de este cambio comunicate con nosotros.</p>';

                $Address=$rT['email'];

                SendMailer($Address, $name, $subject, $emailContent, '','false');

                $Address=$email['corNot'];
                $ename=$email['corNot'];
                $subject='El usuario '.$rT['username'].' ha actualizado su clave';
                $emailContent='<h2><b>'.$subject.'</b></h2>
                                </br>
                                <p >El usuario <b>'.$rT['username'].'</b> Actualizo su clave de acceso.<br/>
                                <b>Password</b>: ******</p>';
                SendMailer($Address, $ename, $subject, $emailContent, '','false');

                echo"true<!----><div class='alert alert-success m-0' role='alert'><center>Contrase&ntilde;a cambiada con &eacute;xito, ahora puede <a href='#' class='alert-link' data-toggle='modal' data-target='#loginModal'>Ingresar</a>.</center></div>";
            }else{
                echo 'false<!----><div class="alert alert-danger m-0" role="alert"><center>Las contrase&ntilde;as no coinciden.</center></div>';
            }
        }
    }
    
    public static function GetStates($bool)
    {
        if(!empty(self::$var1)){
            global $context;

            if(self::$var1!="nulo"){
                $qU = query("SELECT * FROM site_users WHERE id = '" . $context['user']['id'] . "' LIMIT 1");
                $rU = fetch_assoc($qU);

                if($rU['rank']=='2' && $bool=='true'){
                    $q = query("SELECT * FROM states WHERE id = '" . $rU['state'] . "'");
                }else{
                    $q = query("SELECT * FROM states WHERE country_id = '" . self::$var1 . "'");
                    echo '<option value="nulo">Elegir Estado/Provincia</option>';
                }

                while($r = fetch_assoc($q)){

                    if($bool=='true'){

                        $countryDat= query ("SELECT * FROM site_users WHERE state ='" . $r['id'] . "' ");

                        if(num_rows($countryDat)!==0){
                            if($rU['state']==$r['id']){
                                echo '<option selected value="'.$r['id'].'">'. $r['name'] .'</option>';
                            }else{
                                echo '<option value="'.$r['id'].'">'. $r['name'] .'</option>';
                            }
                        }
                    }else{
                        if($rU['state']==$r['id']){
                            echo '<option selected value="'.$r['id'].'">'. $r['name'] .'</option>';
                        }else{
                            echo '<option value="'.$r['id'].'">'. $r['name'] .'</option>';
                        }
                    }
                }
            }else{
                echo '<option value="nulo">Elegir Estado/Provincia</option>';
            }
        }
    }
    
    public static function GetCodesPhones()
    {
        if(!empty(self::$var1)){
            global $context;
            $qU = query("SELECT * FROM site_users WHERE id = '" . $context['user']['id'] . "' LIMIT 1");
            $rU = fetch_assoc($qU);

            $q = query("SELECT * FROM countries ORDER by phonecode ASC");
            if(self::$var1!="nulo"){
                while($r = fetch_assoc($q)){
                    if($r['id']==self::$var1){
                        echo '<option selected value="'.$r['phonecode'].'">+('. $r['phonecode'] .')</option>';
                    }else{
                        echo '<option value="'.$r['phonecode'].'">+('. $r['phonecode'] .')</option>';
                    }
                }
            }else{
                while($r = fetch_assoc($q)){
                        echo '<option value="'.$r['phonecode'].'">+('. $r['phonecode'] .')</option>';
                }
            }
        }
    }
}
?>