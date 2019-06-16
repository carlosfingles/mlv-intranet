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

require('../Init.php');

if(!isset($_SESSION['isLogged']) || $user['rank'] < $context['permissions']['admin_config'])
	header("Location: " . $site['url']);

$titlePage= 'Configuraci&oacute;n';
$descrPage = $titlePage;
include(Templates . 'Head-admin.php');
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
                            <h4 class="font-weight-bold m-0 p1">Configuraci&oacute;n</h4>
                        </li>
                        
                        <li class="list-group-item">
                            <div class="row">
                              <div class="col">
                               <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle blackLinks active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sobre el Sitio</a>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item active" id="logos-tab" data-toggle="tab" href="#logos" role="tab" aria-controls="logos" aria-selected="true">
                                                Logos
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">
                                                Detalles del Sitio
                                            </a>

                                        </div>
                                    </li>
                                    
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle blackLinks" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Otros</a>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item" id="developer-tab" data-toggle="tab" href="#developer" role="tab" aria-controls="developer" aria-selected="false">
                                                Developer
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="false">
                                                Correo Electr&oacute;nico
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">
                                                SEO
                                            </a>

                                        </div>
                                    </li>
                                </ul>

                                <div class="tab-content bg-white p-3" id="myTabContent">
                                  
                                  <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">

                                      <div class="row p-3">

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                         <label>
                                                               T&iacute;tulo del sitio:
                                                           </label>
                                                      </div>
                                                       <div class="col-md-8">
                                                            <input type="text" class="form-control" id="config_title" placeholder="T&iacute;tulo del sitio" value="<?=$site['title'];?>">
                                                            <div class="invalid-feedback respuestaTitle">invalid</div>
                                                            <div class="valid-feedback respuestaTitle">valid</div>
                                                       </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                         <label>
                                                               URL del sitio:
                                                           </label>
                                                      </div>
                                                       <div class="col-md-8">
                                                            <input type="text" class="form-control" id="config_URL" placeholder="Ej: http://localhost/" value="<?=$site['url'];?>">
                                                            <div class="invalid-feedback respuestaURL">invalid</div>
                                                            <div class="valid-feedback respuestaURL">valid</div>
                                                       </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                         <label>
                                                               Descripci&oacute;n del sitio:
                                                           </label>
                                                      </div>
                                                       <div class="col-md-8">
                                                            <input type="text" class="form-control" id="config_desc" placeholder="Descripci&oacute;n..." value="<?=$site['slogan'];?>">
                                                            <div class="invalid-feedback respuestaDesc">invalid</div>
                                                            <div class="valid-feedback respuestaDesc">valid</div>
                                                       </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                         <label>
                                                               Palabras clave:
                                                           </label>
                                                      </div>
                                                       <div class="col-md-8">
                                                            <input type="text" class="form-control" id="config_keys" placeholder="Ejem: clave 1, clave 2, clave 3" value="<?=$site['keywords'];?>">
                                                            <div class="invalid-feedback respuestaKeys">invalid</div>
                                                            <div class="valid-feedback respuestaKeys">valid</div>
                                                       </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <hr/>
                                            <button name="settings_submit" class="btn btn-info float-right">Guardar</button>

                                            <script>
                                                $("[name='settings_submit']").on('click',
                                                        function()
                                                        {
                                                            var title = $("#config_title").val();
                                                            var URL = $("#config_URL").val();
                                                            var desc = $("#config_desc").val();
                                                            var keys = $("#config_keys").val();

                                                            configSettings(title, URL, desc, keys);
                                                        }
                                                    );
                                            </script>
                                        </div>

                                      </div>

                                  </div>
                                  
                                  <div class="tab-pane fade show active" id="logos" role="tabpanel" aria-labelledby="logos-tab">

                                    <div class="row o-h">
                                        <div class="col-12 col-md-6 p-3">
                                            <div class="card mb-3" style="max-width: 100%;">
                                              <div class="row no-gutters">
                                                <div class="col-md-4 bgSectionWhite d-flex justify-content-center align-items-center" style="border-right: 1px solid rgba(0,0,0,.125);">
                                                  <img src="/images/image/<?=$site['logo']?>" style="max-width: 150px;" class="card-img" id="logoImg" alt="Logo">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                       <h6>Logo: <small id="datDeleteLogo" style="color: #315388;"></small></h6>
                                                        <form class="custom-file my-2" method="post" id="upImgLogo" enctype="multipart/form-data">
                                                          <input name="file" onchange="subirLogo()" type="file" class="custom-file-input" id="fileLogo" accept=".jpg, .jpeg, .png, .gif, .svg">
                                                          <label class="custom-file-label o-h" id="imgResultLogo" for="fileLogo">Seleccionar un Logo</label>
                                                          <div class="invalid-feedback respuestalogo">invalid</div>
                                                          <div class="valid-feedback respuestalogo">valid</div>
                                                        </form>
                                                        <br/>
                                                        <div class="progress" id="proLogo" style="display:none;">
                                                            <div id="progressLogo" class="progress-bar progress-bar-striped active" role="progressbar" >
                                                                <span>0%</span>
                                                            </div>
                                                        </div>
                                                        <button onclick="deleteImgLogo()" type="button" class="btn btn-outline-dark float-right mb-3 mt-1">
                                                            <span class="fas fa-trash-alt"></span>
                                                        </button>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 p-3">
                                            <div class="card mb-3" style="max-width: 100%;">
                                              <div class="row no-gutters">
                                                <div class="col-md-4 bgSectionWhite d-flex justify-content-center align-items-center" style="border-right: 1px solid rgba(0,0,0,.125);">
                                                  <img src="/images/favicon/<?=$site['favicon']?>" style="max-width: 150px;" class="card-img" id="FaviconImg" alt="Favicon">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                       <h6>Favicon: <small id="datDeleteFavicon" style="color: #315388;"></small></h6>
                                                        <form class="custom-file my-2" method="post" id="upImgFavicon" enctype="multipart/form-data">
                                                          <input name="file" onchange="subirFavicon()" type="file" accept=".ico" class="custom-file-input" id="fileFavicon">
                                                          <label class="custom-file-label o-h" id="imgResultFavicon" for="fileFavicon">Seleccionar un Favicon</label>
                                                          <div class="invalid-feedback respuestaFavicon">invalid</div>
                                                          <div class="valid-feedback respuestaFavicon">valid</div>
                                                        </form>
                                                        <br/>
                                                        <div class="progress" id="proFavicon" style="display:none;">
                                                            <div id="progressFavicon" class="progress-bar progress-bar-striped active" role="progressbar" >
                                                                <span>0%</span>
                                                            </div>
                                                        </div>
                                                        <button onclick="deleteImgFavicon()" type="button" class="btn btn-outline-dark float-right mb-3 mt-1">
                                                            <span class="fas fa-trash-alt"></span>
                                                        </button>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                  </div>
                                  
                                  <div class="tab-pane fade" id="developer" role="tabpanel" aria-labelledby="developer-tab">

                                      <div class="row">
                                         <div class="col">
                                              <div class="alert alert-warning mt-3" role="alert">
                                                  <p><span class="fas fa-info-circle" aria-hidden="true" style="font-size: 30px;float: left;margin-right: 8px;"></span>Se requiere poseer conocimentos en desarrollo web para usar esta secci&oacute;n. </p>
                                                </div> 
                                         </div>
                                       </div>

                                      <div class="row">
                                         <div class="col">
                                            <div class="card">
                                              <div class="card-header">
                                                Head
                                              </div>
                                              <div class="card-body">

                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <span class="fas fa-code"></span>
                                                    </span>
                                                  </div>
                                                  <textarea name="Develop_head" placeholder="Metadatos o Scripts que deseas agregar a la etiqueta <head></head> del sitio." class="form-control" aria-label="Head" style="height:150px;"><?=stripslashes (htmlspecialchars_decode($site['scriptHead']))?></textarea>

                                                  <div id="resultDevelop" class="valid-feedback"></div>
                                                </div>
                                                <hr/>
                                                <buttom type="submit" name="Develop_submit" class="btn btn-info float-right">Guardar</buttom>
                                                <script>
                                                    $("[name='Develop_submit']").on('click',
                                                        function()
                                                        {
                                                            var head = $("textarea[name='Develop_head']").val();							configDevelop(head);
                                                        }
                                                    );
                                                </script>
                                              </div>
                                            </div>
                                         </div>
                                       </div>

                                  </div>
                                  
                                  <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">

                                    <div class="alert alert-info mt-3" role="alert">
                                       <span class="fas fa-info-circle float-left mr-2" aria-hidden="true" style="font-size: 30px;"></span> Se requiere de un certificado ssl o tls y un servidor SMTP para usar las notificaciones por correo electr&oacute;nico.
                                    </div>

                                       <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="custom-control custom-switch float-left">
                                                            <input type="checkbox" onclick="configEmail()" class="custom-control-input" id="configEmailChek" <?php if($email['correoBool']=='true'){echo 'checked';}?> />
                                                            <label class="custom-control-label" for="configEmailChek">
                                                              Activar notificaciones por correo electr&oacute;nico
                                                            </label>
                                                            <div class="valid-feedback respuestaConfigEmailChek">valid</div>
                                                       </div>
                                                    </div>
                                                </div>
                                           </div>
                                      </div>

                                    <?php
                                        if($email['correoBool']=='true'){
                                        ?>
                                        <hr/>
                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Servidor SMTP:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="mail_server" class="form-control" placeholder="Ejem: smtp.site.com" value="<?=$email['smtpServer']?>">
                                                    </div>
                                                </div>
                                            </div>
                                      </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Usuario:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="mail_user" class="form-control" placeholder="Ejem: user@site.com" value="<?=$email['user']?>">
                                                    </div>
                                                </div>
                                            </div>
                                      </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Contrase&ntilde;a:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="mail_pass" class="form-control" placeholder="Ejem: Password" value="<?=$email['pass']?>">
                                                    </div>
                                                </div>
                                            </div>
                                      </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Encripaci&oacute;n:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select id="mail_encryp" class="form-control custom-select">
                                                            <option <?php if($email['encryp']=='ssl'){echo'selected';}?>>ssl</option>
                                                            <option <?php if($email['encryp']=='tls'){echo'selected';}?>>tls</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Puerto:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="mail_port" class="form-control" placeholder="Ejem: 465/587" value="<?=$email['port']?>">
                                                    </div>
                                                </div>
                                            </div>
                                      </div>
                                        
                                      <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Notificaciones administrativas:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="mail_corNot" class="form-control" placeholder="Ejem: user1@server.com,user2@server.com,user3@server.com" value="<?=$email['corNot']?>">
                                                    </div>
                                                </div>
                                            </div>
                                      </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                   <div class="col-md-12">
                                                        <div id="restConfigEmailSend" class="float-left">
                                                        </div>

                                                        <button id="ConfigEmailSend" onclick="btnConfigEmailSend()" class="btn btn-info float-right">
                                                            Guardar
                                                        </button>
                                                        <script>
                                                            function btnConfigEmailSend(){
                                                                var mail_server = $('#mail_server').val();
                                                                var mail_user = $('#mail_user').val();
                                                                var mail_pass =$('#mail_pass').val();
                                                                var mail_encryp =$('#mail_encryp').val();
                                                                var mail_port =$('#mail_port').val();
                                                                var mail_corNot =$('#mail_corNot').val();

                                                                configEmailSend(mail_server, mail_user, mail_pass, mail_encryp, mail_port, mail_corNot);
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>
                                    <?php          
                                        }
                                    ?>

                                  </div>
                                  
                                  <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">

                                        <div class="col-12 px-0 mt-3">
                                            <div class="card mb-3" style="max-width: 100%;">
                                              <div class="row no-gutters">
                                                <div class="col-md-4 bgSectionWhite d-flex justify-content-center align-items-center" style="border-right: 1px solid rgba(0,0,0,.125);">
                                                  <img src="/images/image/seo_og/<?=$site['ogImg'];?>" style="max-width: 150px;" class="card-img" id="OgSeoImg" alt="OgSeo">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                       <h6>Imagen: <small id="datDeleteOgSeo" style="color: #315388;"></small></h6>
                                                        <form class="custom-file my-2" method="post" id="upImgOgSeo" enctype="multipart/form-data">
                                                          <input name="file" onchange="subirOgSeo()" type="file" class="custom-file-input" id="fileOgSeo" accept=".jpg, .jpeg">
                                                          <label class="custom-file-label o-h" id="imgResultOgSeo" for="fileOgSeo">Seleccionar una imagen</label>
                                                          <div class="invalid-feedback respuestaOgSeo">invalid</div>
                                                          <div class="valid-feedback respuestaOgSeo">valid</div>
                                                        </form>
                                                        <br/>
                                                        <div class="progress" id="proOgSeo" style="display:none;">
                                                            <div id="progressOgSeo" class="progress-bar progress-bar-striped active" role="progressbar" >
                                                                <span>0%</span>
                                                            </div>
                                                        </div>
                                                        <button onclick="deleteImgOgSeo()" type="button" class="btn btn-outline-dark float-right mb-3 mt-1">
                                                            <span class="fas fa-trash-alt"></span>
                                                        </button>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="card w-100 mt-3">
                                            <div class="card-body">
                                                <div class="custom-control custom-switch float-left">
                                                    <input type="checkbox" onclick="configTwitterCard()" class="custom-control-input" id="twitterCardChek" <?php if($site['twitterSeo']=='true'){echo 'checked'; } ?> />
                                                    <label class="custom-control-label" for="twitterCardChek">
                                                      Usar Twitter Card
                                                    </label>
                                                    <div class="valid-feedback respuestaTwitterCard">valid</div>
                                               </div>
                                            </div>
                                        </div>

                                    <?php if($site['twitterSeo']=='true'){?>
                                        <hr/>

                                        <div class="alert alert-info" role="alert">
                                           Antes de que nuestra carta se muestre en Twitter es necesario tener primero aprobado el dominio. Afortunadamente es muy sencillo. Haz <a href="https://cards-dev.twitter.com/validator" class="alert-link" target="_blank">click aqu&iacute;</a> para entrar al sitio de aprobaci&oacute;n y luego pon la URL de tu sitio y click en el bot&oacute;n.
                                           <hr/>
                                           <small>Facebook ofrece una opci&oacute;n similar solo que este no requiere de una aporvaci&oacute;n anticipada. <a href="https://developers.facebook.com/tools/debug/" class="alert-link" target="_blank">Click aqu&iacute;.</a></small>    
                                        </div>

                                        <div class="col-12 px-0">
                                            <div class="card mb-3" style="max-width: 100%;">
                                              <div class="row no-gutters">
                                                <div class="col-md-4 bgSectionWhite d-flex justify-content-center align-items-center" style="border-right: 1px solid rgba(0,0,0,.125);">
                                                  <img src="/images/image/seo_twitter/<?=$site['twitterImg'];?>" style="max-width: 150px;" class="card-img" id="TwitterCardImg" alt="TwitterCard">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                       <h6>Imagen: <small id="datDeleteTwitterCard" style="color: #315388;"></small></h6>
                                                        <form class="custom-file my-2" method="post" id="upImgTwitterCard" enctype="multipart/form-data">
                                                          <input name="file" onchange="subirTwitterCard()" type="file" class="custom-file-input" id="fileTwitterCard" accept=".jpg, .jpeg">
                                                          <label class="custom-file-label o-h" id="imgResultTwitterCard" for="fileTwitterCard">Seleccionar una imagen</label>
                                                          <div class="invalid-feedback respuestaTwitterCard">invalid</div>
                                                          <div class="valid-feedback respuestaTwitterCard">valid</div>
                                                        </form>
                                                        <br/>
                                                        <div class="progress" id="proTwitterCard" style="display:none;">
                                                            <div id="progressTwitterCard" class="progress-bar progress-bar-striped active" role="progressbar" >
                                                                <span>0%</span>
                                                            </div>
                                                        </div>
                                                        <button onclick="deleteImgTwitterCard()" type="button" class="btn btn-outline-dark float-right mb-3 mt-1">
                                                            <span class="fas fa-trash-alt"></span>
                                                        </button>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="card w-100 mb-3">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                         <label>
                                                               <span class="socicon socicon-twitter"></span> - Usuario de Twitter:
                                                           </label>
                                                      </div>
                                                       <div class="col-md-8">

                                                           <div class="input-group mb-3">
                                                              <div class="input-group-prepend">
                                                                <span class="input-group-text" id="userTwitter">@</span>
                                                              </div>

                                                              <input id="config_twUser" type="text" class="form-control" placeholder="Usuario de Twitter" aria-describedby="userTwitter" value="<?=$site['twitterUser'];?>">

                                                              <div class="input-group-append">
                                                                <button name="TwitterCard_submit" class="btn btn-outline-secondary" type="button" style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;">Guardar</button>
                                                              </div>

                                                              <div class="invalid-feedback respuestaTwUser">invalid</div>
                                                              <div class="valid-feedback respuestaTwUser">valid</div>
                                                          </div>
                                                          <script>
                                                                $("[name='TwitterCard_submit']").on('click',
                                                                        function()
                                                                        {
                                                                            var twUser = $("#config_twUser").val();

                                                                            configTwitterCardUser(twUser);
                                                                        }
                                                                    );
                                                            </script>

                                                       </div>

                                                </div>
                                            </div>
                                        </div>

                                     <?php } ?>

                                  </div>
                                </div>
                               </div>
                           </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
include(Templates . 'Footer.php');
?>