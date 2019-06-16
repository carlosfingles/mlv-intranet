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

require('Init.php');

if(isset($_SESSION['isLogged']))
	header("Location: " . $site['url']);

$titlePage= 'Restablecer Contrase&ntilde;a';
$descrPage = '¿Se te olvidó tu contraseña?';

include(Templates . 'Head.php');
?>
  <div class="container-fluid content-min-100vh">
        <div class="row">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-body font-size-14">
                        <center>
                            <h1 class="font-weight-bold h1-1">INTRANET VERSION ALPHA.</h1>
                            <p>Esta pagina esta en evolucion permanente. En caso de problemas, por favor contactanos a: <a href="mailto:it@mlv-intranet.org" class="text-dark">it@mlv-intranet.org</a></p>
                            <p style="font-size: 90%;" class="font-weight-bold">Si eres desarrollador web, colabora para mejorar la pagina!</p>
                        </center>
                    </div>
                </div>
                <div class="card mb-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="font-weight-bold m-0 p1">Restablecer Contrase&ntilde;a</h4>
                        </li>
                        
                        <li class="list-group-item">
<?php
    if($email['correoBool']!='true'){
    ?>
    <div class="row">
        <div class="col">
            <div class="card w-100 my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            Las notificaciones por correo electr&oacute;nico estan desactivadas.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }else{
?>
  <div class="row">
      <div class="col p-4">
        <?php
         if(!isset($_GET['key'])){
        ?>
         <div class="card w-100">
             <div class="card-body">
                 <div class="row">
                    <div class="col-12">
                        <label>
                            Ingrese un usuario o un correo electr&oacute;nico:
                        </label>
                    </div>
                     <div class="col-12">                         
                        <div class="input-group mb-3">
                          <input type="text" id="forgotUser" class="form-control" placeholder="Usuario o Correo Electr&oacute;nico" aria-describedby="forgotPassSend">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="forgotPassSend" onclick="forgotPassSend()">Enviar</button>
                          </div>
                        </div>
                         
                         <div id="RestforgotPass" class="px-1">
                         </div>
                         
                         <script>
                            function forgotPassSend(){
                                var forgotUser = $('#forgotUser').val();    
                                forgotPassword(forgotUser);
                            }
                         </script>
                     </div>
                 </div>
             </div>
         </div>
         <?php
         }else{
             $q = query("SELECT * FROM site_data_emails WHERE keyPr = '".$_GET['key']."' AND type = 'forgotPass' LIMIT 1");

            if(num_rows($q) != 0)
            {
                $r = fetch_assoc($q);
                $qU = query("SELECT * FROM site_users WHERE id = '".$r['id_user']."' ");
                if(num_rows($qU) != 0)
                {
                    $rU = fetch_assoc($qU);
                ?>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Cambiar contrase&ntilde;a a: <?=$rU['username']?></h4>
                                    
                                    <div class="row mb-3">
                                       <div class="col">
                                          <label>
                                              Nueva Contrase&ntilde;a:
                                          </label>
                                           <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="inputGroupEditPass1">
                                                      <span class="fas fa-key"></span>
                                                  </span>
                                                </div>
                                                <input type="password" class="form-control" placeholder="Nueva Contrase&ntilde;a" name="forgotPass_password" id="forgotPass_password" aria-describedby="inputGroupEditPass1">
                                          </div>
                                       </div>
                                    </div>

                                    <div class="row mb-3">
                                       <div class="col">
                                          <label>
                                              Repetir Contrase&ntilde;a:
                                          </label>
                                           <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="inputGroupEditPass2">
                                                      <span class="fas fa-key"></span>
                                                  </span>
                                                </div>
                                                <input type="password" class="form-control" placeholder="Repetir Contrase&ntilde;a" name="forgotPass_repeatpass" id="forgotPass_repeatpass" aria-describedby="inputGroupEditPass2">
                                          </div>
                                       </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                       <div class="col">
                                          <hr/>
                                          <div class="float-left" id="restUpdatePass">
                                          </div>
                                          <button id="updatePass" onclick="updatePassSend()" class="btn btn-info float-right">Cambiar Contrase&ntilde;a</button>
                                          <script>
                                              function updatePassSend(){
                                                  var pass = $('#forgotPass_password').val();
                                                  var repass = $('#forgotPass_repeatpass').val();
                                                  
                                                  updatePass(pass, repass, <?=$rU['id']?>);
                                              }
                                          </script>
                                       </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                
                <?php    
                }else{
                ?>
                <div class="card w-100">
                    <div class="card-header">
                        <center>Error 404 >> P&aacute;gina no encontrada</center>
                      </div>
                       <div class="card-body bgSectionWhite d-flex justify-content-center align-items-center"> 
                           <img src="../../images/image/images/404.png" class="inselect" style="width: 100%; height: auto; max-width: 604px;">
                       </div>
                </div>
                <?php
                }
                
            }else{
            ?>
            <div class="card w-100">
                <div class="card-header">
                    <center>Error 404 >> P&aacute;gina no encontrada</center>
                  </div>
                   <div class="card-body bgSectionWhite d-flex justify-content-center align-items-center"> 
                       <img src="../../images/image/images/404.png" class="inselect" style="width: 100%; height: auto; max-width: 604px;">
                   </div>
            </div>
            <?php
            }     
         }
          ?>
      </div>
    </div>
<?php
    }
?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
include(Templates . 'Footer.php');
?>