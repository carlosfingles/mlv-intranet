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
?>
<nav id="navMenuPr" class="navbar navbar-expand-lg navbar-light bg-light shadowBorder">
 
  <a class="navbar-brand" href="<?=$context['site']['url'];?>">
      <img src="<?=$context['site']['url'];?>images/image/<?=$site['logo']?>" style="min-width:40px; max-width: 40px"  height="40" class="mr-2"> <?=$site['title']?>
  </a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrincpal" aria-controls="navbarPrincpal" aria-expanded="false" aria-label="Toggle navigation">
    <span class="fas fa-bars"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarPrincpal">
   
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      
      <?php		if(!isset($_SESSION['isLogged']))		{		?>
      
      <li class="nav-item">
        <a class="nav-link">
            <button type="button" class="w-lg-100 btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#loginModal">
                Ingresar
            </button>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link">
            <button type="button" data-toggle="modal" data-target="#joinUpModal" class="w-lg-100 btn btn-warning btn-sm">Reg&iacute;strate</button>
        </a>
      </li>
      
      <?php		}		else		{ 	?>
      
      <li class="nav-item mx-lg-2 mt-lg-2">
       
       <div class="dropdown">
          <a class="w-lg-100 btn btn-sm btn-dark dropdown-toggle d-flex align-items-center" href="#" role="button" id="MenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatarNav" style="background-image: url('<?=$context['site']['url'];?>images/imgperfil/<?=$user['avatar']?>');"></div>
                <?=$user['username'];?>
          </a>
          
          <div class="dropdown-menu dropdown-menu-right w-lg-100 position-absolute" aria-labelledby="MenuProfile">
           
            <?=$user['rank'] >= 2 ? '  <a class="dropdown-item" href="' . $context['site']['url'] . 'manage" data-toggle="tooltip" title="Administraci&oacute;n"><span class="fas fa-wrench"></span> Administraci&oacute;n</a> <div class="dropdown-divider"></div>' : '';?>
            
            <a class="dropdown-item" href="<?=$context['site']['url'];?>profile/<?=$user['username'];?>"><span class="fas fa-user"></span> Perfil</a>
            
            <a class="dropdown-item" href="<?=$context['site']['url'];?>account"><span class="fas fa-edit"></span> Editar</a>
            
            <div class="dropdown-divider"></div>
            
            <a class="dropdown-item" href="<?=$context['site']['url'];?>logout"><span class="fas fa-sign-out-alt"></span> Salir</a>
            
          </div>
        </div>
      </li>
      <?php		}		?>
      
    </ul>
  </div>
</nav>

<?php		if(!isset($_SESSION['isLogged']))		{		?>

<script>
$(document).bind('keydown',
	function(e)
	{
		if(e.which == 13)
			$("button[name='login']").click();
	}
);
</script>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-sign-in-alt"></span> Ingresar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <center id="inseleccionable" class="p-1">
                <img class="inselect" id="imgLog" src="<?=$site['url']?>images/image/<?=$site['logo']?>" style="border-radius: 50%;" width="80px" height="80px"/>
            </center>
            
           <div class="form-group">
                
            <?php
               function rememberUser(){
                   if(isset($_COOKIE['RememberMe']) && $_COOKIE['RememberMe']!=NULL && $_COOKIE['RememberMe']!='NULL' && $_COOKIE['RememberMe']!='null'){
                       return $_COOKIE['RememberMe'];
                   }
               }
               ?>
                
                <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupEmail">
                              <span class="fas fa-at"></span>
                          </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Usuario o Correo electr&oacute;nico" name="email" id="email" value="<?=rememberUser();?>" aria-describedby="inputGroupEmail">
                        
                        <div id="resultEmail" class="invalid-feedback">
                        </div>
                </div>
                
                <br/>
                
                <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPassword">
                              <span class="fas fa-key"></span>
                          </span>
                        </div>
                        <input type="password" class="form-control" placeholder="Contrase&ntilde;a" name="password" id="password" aria-describedby="inputGroupPassword">
                        
                        <div id="resultPass" class="invalid-feedback">
                        </div>
                </div>
                <br/>
                <div class="custom-control custom-switch float-left">
                    <input type="checkbox" class="custom-control-input" id="rememberMeChek" checked />
                    <label class="custom-control-label" for="rememberMeChek">
                      Recu&eacute;rdame
                    </label>
               </div>
               
               <button type="submit" name="login" id="login" class="btn btn-warning float-right">
                   Aceptar
               </button>
            </div>
                    
      </div>
      <div class="modal-footer d-flex justify-content-start">
        <a style="color: #333;" href="<?=$site['url']?>forgotPassword">¿Se te olvid&oacute; tu contrase&ntilde;a?</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="joinUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-address-card"></span> Reg&iacute;starte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <div class="row">
               <div class="col-md-12">
                    <h4>Datos personales</h4>
                    <hr class="mt-1 mb-3"/>
                </div>
                <div class="col-md-6">
                   
                    <label>Nombres*</label>
                    <input type="text" class="form-control mb-2" placeholder="Nombres" name="reg_name" id="reg_name">
                    <div id="resultRegName" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                <div class="col-md-6">
                   
                    <label>Apellidos*</label>
                    <input type="text" class="form-control mb-2" placeholder="Apellidos" name="reg_lastname" id="reg_lastname">
                    <div id="resultRegLastName" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                
                <div class="col-md-6">
                   
                    <label>Usuario*</label>
                    <input type="text" class="form-control mb-2" placeholder="Usuario" name="reg_username" id="reg_username">
                    <div id="resultRegUsername" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                <div class="col-md-6">
                   
                    <label>Correo electr&oacute;nico*</label>
                    <input type="text" class="form-control mb-2" placeholder="user@ejemplo.com" name="reg_email" id="reg_email">
                    <div id="resultRegEmail" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                
                <div class="col-md-6">
                   
                    <label>Contrase&ntilde;a*</label>
                    <input type="password" class="form-control mb-2" placeholder="Contrase&ntilde;a" name="reg_password" id="reg_password">
                    <div id="resultRegPass" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div> 
                     
                </div>
                <div class="col-md-6">
                   
                   <label>C&eacute;dula de identidad*</label>
                   <div class="input-group">
                       <select class="form-control custom-select" id="reg_CI_type" style="max-width: 75px;">
                           <option>V</option>
                           <option>E</option>
                       </select>
                       <input type="text" class="form-control mb-2" placeholder="C&eacute;dula" name="reg_CI" id="reg_CI">
                        <div id="resultRegCI" class="invalid-feedback">
                            No puedes dejar este campo vacio.
                        </div>
                    </div>
                    
                </div>       
                
                <div class="col-md-4">
                   
                   <label>Fecha de nacimiento*</label>
                   <input type="date" class="form-control mb-2" value="<?=date('Y-m-d');?>" name="reg_birthdate" id="reg_birthdate">
                    <div id="resultRegBirthdate" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                <div class="col-md-8">
                   
                   <label>Profesi&oacute;n* (por favor, sea lo mas específico posible)</label>
                   <input type="text" class="form-control mb-2" name="reg_profession" id="reg_profession" placeholder="¿A qu&eacute; te dedicas?">
                    <div id="resultRegProfession" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                
                <div class="col-md-6">
                  <label>Teléfono*</label>
                   <form class="form-inline w-100">
                    <div class="input-group w-100">
                         <select id="reg_codephone" class="form-control custom-select" style="max-width: 130px;">
                             <option value="58">+(58)</option>
                             <?php
                             $qCountry = query("SELECT * FROM countries  ORDER by phonecode ASC");
                             while($rCountry = fetch_assoc($qCountry)){
                                if($rCountry['phonecode']==$rT['codephone']){
                                    echo '<option selected value="'.$rCountry['phonecode'].'">+('. $rCountry['phonecode'] .')</option>';
                                }else{
                                    echo '<option value="'.$rCountry['phonecode'].'">+('. $rCountry['phonecode'] .')</option>';
                                }
                            }
                            ?>
                         </select>
                           <input type="text" class="form-control mb-2" name="reg_phone" id="reg_phone" placeholder="0000000">
                            <div id="resultRegPhone" class="invalid-feedback">
                                No puedes dejar este campo vacio.
                            </div>
                    </div>
                   </form>
                </div>
                <div class="col-md-6">
                   
                   <label>¿Tienes WhatsApp/Telegram?</label>
                   
                   <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="reg_wtpp">
                    <label class="custom-control-label" for="reg_wtpp">WhatsApp</label>
                  </div>
                   
                   <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="reg_tlg">
                    <label class="custom-control-label" for="reg_tlg">Telegram</label>
                  </div>
                    
                </div>
                
                <div class="col-md-12">
                    <h4 class="mt-3">Dirección de residencia</h4>
                    <hr class="mt-1 mb-3"/>
                </div>
                
                <div class="col-md-6">
                    <label>
                        Pa&iacute;s donde vives actualmente*
                    </label>
                     <select id="reg_country" onchange="viewStates();" class="form-control mb-2 custom-select">
                          <option value="nulo">Elegir Pais</option>
                          <?php
                           $datCountries= query("SELECT * FROM countries  ORDER by id ASC");

                            while($countries = fetch_assoc($datCountries))
                                   {
                                    if($countries['id']==$rT['country']){
                                        echo'<option selected value="'.$countries['id'].'">'.$countries['name'].'</option>';
                                    }else{
                                        echo'<option value="'.$countries['id'].'">'.$countries['name'].'</option>';
                                    }

                                   }
                            ?>
                    </select>
                 </div>

                 <div class="col-md-6">
                    <label>
                        Estado/Provincia*
                    </label>
                     <select id="reg_states" class="form-control mb-2 custom-select">
                          <option value="nulo">Elegir Estado/Provincia</option>
                     </select>
                     <script>viewStates();</script>
                 </div>
                 
                <div class="col-md-12">
                   
                   <label>Ciudad</label>
                   <input type="text" class="form-control mb-2" name="reg_city" id="reg_city" placeholder="Ciudad de residencia">
                    <div id="resultRegCity" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                
                <div class="col-md-12">
                    <h4 class="mt-3">Ideología <a href="http://www.testpolitico.com/" target="_blank"><span class="badge badge-info" style="font-size: 40%;">Tomar el test</span></a></h4>
                    <hr class="mt-1 mb-3"/>
                </div>
                <div class="col-md-6">
                    <label>
                        Ideología*
                    </label>
                     <select id="reg_ideology" class="form-control mb-2 custom-select">
                          <option>Liberal</option>
                          <option>Minarquista</option>
                          <option>Anarcocapitalista</option>
                          <option>Otro</option>
                     </select>
                </div>
                <div class="col-md-6">
                   
                   <label>Resultados del test</label>
                   <div class="input-group mb-2">
                      <input type="text" id="reg_social" class="form-control" placeholder="Social">
                      <input type="text" id="reg_economic" class="form-control" placeholder="Econ&oacute;mico">
                    </div>
                    
                </div>
                
                <div class="col-md-12">
                    <h4 class="mt-3">¿Has sido parte de alguna otra organización?</h4>
                    <hr class="mt-1 mb-3"/>
                </div>
                <div class="col-md-12">
                   
                    <textarea class="form-control mb-2" name="reg_anotherOrganization" id="reg_anotherOrganization" placeholder="Dinos Aqu&iacute;"></textarea>
                    
                </div>
                
                <div class="col-md-12">
                    <h4 class="mt-3">Redes sociales</h4>
                    <hr class="mt-1 mb-3"/>
                </div>
                <div class="col-md-4">
                   
                   <label>Primera red social*</label>
                   <input type="text" class="form-control mb-2" name="reg_net1" id="reg_net1" placeholder="Primera red social">
                    <div id="resultRegNet1" class="invalid-feedback">
                        No puedes dejar este campo vacio.
                    </div>
                    
                </div>
                <div class="col-md-4">
                   
                   <label>Segunda red Social</label>
                   <input type="text" class="form-control mb-2" name="reg_net2" id="reg_net2" placeholder="Segunda red Social">
                    
                </div>
                <div class="col-md-4">
                   
                   <label>Tercera red social</label>
                   <input type="text" class="form-control mb-2" name="reg_net3" id="reg_net3" placeholder="Tercera red social">
                    
                </div>
                
                <div class="col-md-12">
                    <h4 class="mt-3">¿Como te gustaria colaborar con el MLV?</h4>
                    <hr class="mt-1 mb-3"/>
                </div>
                <div class="col-md-6">
                   
                   <label>Compartiendo contenido a traves de las redes.*</label>
                   <select id="reg_collabNet" class="form-control mb-2 custom-select">
                          <option value="1">Si</option>
                          <option value="0">No</option>
                     </select>
                    
                </div>
                <div class="col-md-6">
                   
                   <label>Ayudando en tu tiempo libre como voluntario.*</label>
                   <select id="reg_collabVoluntary" class="form-control mb-2 custom-select">
                          <option value="1">Si</option>
                          <option value="0">No</option>
                     </select>
                    
                </div>
                    
                <div class="col-md-6">
                   
                   <label>Participando en nuestros eventos oficiales en Venezuela.*</label>
                   <select id="reg_collabEvents" class="form-control mb-2 custom-select">
                          <option value="1">Si</option>
                          <option value="0">No</option>
                     </select>
                    
                </div>
                <div class="col-md-6">
                   
                   <label>Aportando fondos y donaciones.*</label>
                   <select id="reg_collabFunds" class="form-control mb-2 custom-select">
                          <option value="1">Si</option>
                          <option value="0">No</option>
                     </select>
                    
                </div>
                    
                <div class="col-md-12">
                   
                   <label>¿Hay alguna otra forma como te gustaria colaborar?</label>
                   <textarea id="reg_collabOther" class="form-control mb-2" placeholder="Dinos aqu&iacute;"></textarea>
                    
                </div>
                 
            </div>
                    
      </div>
      <div class="modal-footer">
            <button type="submit" name="register" id="register" class="btn btn-warning float-right">
                Aceptar
            </button>
      </div>
    </div>
  </div>
</div>

<?php } ?>