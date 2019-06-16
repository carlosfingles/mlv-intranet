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

if(!isset($_SESSION['isLogged']) || $user['rank'] < $context['permissions']['admin_users'])
	header("Location: " . $site['url']);

$profile= $_GET['q'];

$sql = query("SELECT * FROM site_users WHERE username = '" . $profile . "' LIMIT 1");

if(num_rows($sql) == 0)
{
    	header("Location: " . $site['url']. 'manage/Error404');
}else{
    $rT = fetch_assoc($sql);

if($user['rank']=='2'){
    if($user['state']!=$rT['state']){
        header("Location: " . $site['url']);
    }
}

$titlePage= 'Actualizar datos de: ' .$rT['name'].' '.$rT['lastname'];
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
                            <h4 class="font-weight-bold m-0 p1">Informacion personal de: <?=$rT['name']?> <?=$rT['lastname']?></h4>
                        </li>
                        
                        <li class="list-group-item">
                            <nav class="mb-3">
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active text-dark" id="nav-img-tab" data-toggle="tab" href="#nav-img" role="tab" aria-controls="nav-img" aria-selected="true">Avatar</a>
                            <a class="nav-item nav-link text-dark" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Datos</a>
                            <a class="nav-item nav-link text-dark" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab" aria-controls="nav-settings" aria-selected="false">Ajustes</a>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            
                            <div class="tab-pane fade show active" id="nav-img" role="tabpanel" aria-labelledby="nav-img-tab">
                               <div class="row">
                                   <div class="col-md-6">
                                       
                                        <div class="card mb-3 w-100" style="max-height: 180px:">
                                          <div class="row no-gutters">
                                            <div class="col-md-12 bgSectionWhite d-flex justify-content-center align-items-center">
                                              <img src="/images/imgperfil/<?=$rT['avatar']?>" class="card-img" id="ProfileImg" alt="Profile" style="width: auto !important;height: 150px;">
                                            </div>
                                          </div>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                       
                                        <div class="card mb-3 w-100" style="max-height: 180px:">
                                          <div class="row no-gutters">
                                            <div class="col-md-12 bgSectionWhite d-flex justify-content-center align-items-center">
                                              <img src="/images/imgcover/<?=$rT['cover']?>" class="card-img" id="CoverImg" alt="Cover" style="width: auto !important;height: 150px;">
                                            </div>
                                          </div>
                                        </div>
                                   </div>
                               </div>
                            </div>
                            
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                           <div class="col-md-12">
                                                <h4>Datos personales</h4>
                                                <hr class="mt-1 mb-3"/>
                                            </div>
                                            <div class="col-md-6">

                                                <label>Nombres*</label>
                                                <input type="text" class="form-control mb-2" placeholder="Nombres" name="reg_name" id="reg_name" value="<?=$rT['name']?>">
                                                <div id="resultRegName" class="invalid-feedback">
                                                    No puedes dejar este campo vacio.
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <label>Apellidos*</label>
                                                <input type="text" class="form-control mb-2" placeholder="Apellidos" name="reg_lastname" id="reg_lastname" value="<?=$rT['lastname']?>">
                                                <div id="resultRegLastName" class="invalid-feedback">
                                                    No puedes dejar este campo vacio.
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                               <?php
                                                $ci = explode('-',$rT['curp']);
                                                ?>
                                               <label>C&eacute;dula de identidad*</label>
                                               <div class="input-group">
                                                   <select class="form-control custom-select" id="reg_CI_type" style="max-width: 75px;">
                                                       <option <?php if($ci[0]=='V'){echo'selected';}?> >V</option>
                                                       <option <?php if($ci[0]=='E'){echo'selected';}?> >E</option>
                                                   </select>
                                                   <input type="text" class="form-control mb-2" placeholder="C&eacute;dula" name="reg_CI" id="reg_CI" value="<?php if(isset($ci[1])){echo $ci[1];}?>">
                                                    <div id="resultRegCI" class="invalid-feedback">
                                                        No puedes dejar este campo vacio.
                                                    </div>
                                                </div>

                                            </div>       

                                            <div class="col-md-6">

                                               <label>Fecha de nacimiento*</label>
                                               <input type="date" class="form-control mb-2" value="<?=$rT['birthdate'];?>" name="reg_birthdate" id="reg_birthdate">
                                                <div id="resultRegBirthdate" class="invalid-feedback">
                                                    No puedes dejar este campo vacio.
                                                </div>

                                            </div>
                                            <div class="col-md-12">

                                               <label>Profesi&oacute;n* (por favor, sea lo mas específico posible)</label>
                                               <input type="text" class="form-control mb-2" name="reg_profession" id="reg_profession" placeholder="¿A qu&eacute; te dedicas?" value="<?=$rT['profession'];?>">
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
                                                       <input type="text" class="form-control mb-2" name="reg_phone" id="reg_phone" placeholder="0000000" value="<?=$rT['phone'];?>">
                                                        <div id="resultRegPhone" class="invalid-feedback">
                                                            No puedes dejar este campo vacio.
                                                        </div>
                                                </div>
                                               </form>
                                            </div>
                                            <div class="col-md-6">

                                               <label>¿Tienes WhatsApp/Telegram?</label>

                                               <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="reg_wtpp" <?php if($rT['whatsapp']=='1'){echo'checked';}?> >
                                                <label class="custom-control-label" for="reg_wtpp">WhatsApp</label>
                                              </div>

                                               <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="reg_tlg" <?php if($rT['telegram']=='1'){echo'checked';}?>>
                                                <label class="custom-control-label" for="reg_tlg">Telegram</label>
                                              </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
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
                                                 <script>
                                                     viewStates('<?=$rT['state']?>');
                                                 </script>
                                             </div>

                                            <div class="col-md-12">

                                               <label>Ciudad</label>
                                               <input type="text" class="form-control mb-2" name="reg_city" id="reg_city" placeholder="Ciudad de residencia" value="<?=$rT['city']?>">
                                                <div id="resultRegCity" class="invalid-feedback">
                                                    No puedes dejar este campo vacio.
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="mt-3">Ideología <a href="http://www.testpolitico.com/" target="_blank"><span class="badge badge-info" style="font-size: 40%;">Tomar el test</span></a></h4>
                                                <hr class="mt-1 mb-3"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    Ideología*
                                                </label>
                                                 <select id="reg_ideology" class="form-control mb-2 custom-select">
                                                      <option <?php if($rT['ideology']=='Liberal'){echo'selected';}?> >Liberal</option>
                                                      <option <?php if($rT['ideology']=='Minarquista'){echo'selected';}?>>Minarquista</option>
                                                      <option <?php if($rT['ideology']=='Anarcocapitalista'){echo'selected';}?>>Anarcocapitalista</option>
                                                      <option <?php if($rT['ideology']=='Otro'){echo'selected';}?>>Otro</option>
                                                 </select>
                                            </div>
                                            <div class="col-md-6">

                                               <label>Resultados del test</label>
                                               <div class="input-group mb-2">
                                                  <input type="text" id="reg_social" class="form-control" placeholder="Social" value="<?=$rT['socialTest'];?>">
                                                  <input type="text" id="reg_economic" class="form-control" placeholder="Econ&oacute;mico" value="<?=$rT['economicTest'];?>">
                                                </div>

                                            </div>

                                            <div class="col-md-12">
                                                <h4 class="mt-3">¿Has sido parte de alguna otra organización?</h4>
                                                <hr class="mt-1 mb-3"/>
                                            </div>
                                            <div class="col-md-12">

                                                <textarea class="form-control mb-2" name="reg_anotherOrganization" id="reg_anotherOrganization" placeholder="Dinos Aqu&iacute;"><?=$rT['anotherOrganization'];?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="mt-3">Redes sociales</h4>
                                                <hr class="mt-1 mb-3"/>
                                            </div>
                                            <div class="col-md-4">
                                               <?php
                                                $redes=explode('-/*S*/-',$rT['networkings']);
                                                ?>
                                               <label>Primera red social*</label>
                                               <input type="text" class="form-control mb-2" name="reg_net1" id="reg_net1" placeholder="Primera red social" value="<?=$redes[0]?>">
                                                <div id="resultRegNet1" class="invalid-feedback">
                                                    No puedes dejar este campo vacio.
                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                               <label>Segunda red Social</label>
                                               <input type="text" class="form-control mb-2" name="reg_net2" id="reg_net2" placeholder="Segunda red Social"  value="<?php if(isset($redes[1])){echo $redes[1];}?>">

                                            </div>
                                            <div class="col-md-4">

                                               <label>Tercera red social</label>
                                               <input type="text" class="form-control mb-2" name="reg_net3" id="reg_net3" placeholder="Tercera red social"  value="<?php if(isset($redes[2])){echo $redes[2];}?>">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="mt-3">¿Como te gustaria colaborar con el MLV?</h4>
                                                <hr class="mt-1 mb-3"/>
                                            </div>
                                            <div class="col-md-6">

                                               <label>Compartiendo contenido a traves de las redes.*</label>
                                               <select id="reg_collabNet" class="form-control mb-2 custom-select">
                                                      <option value="1" <?php if($rT['sharingInNetworks']=='1'){echo'selected';}?> >Si</option>
                                                      <option value="0" <?php if($rT['sharingInNetworks']=='0'){echo'selected';}?> >No</option>
                                                 </select>

                                            </div>
                                            <div class="col-md-6">

                                               <label>Ayudando en tu tiempo libre como voluntario.*</label>
                                               <select id="reg_collabVoluntary" class="form-control mb-2 custom-select">
                                                      <option value="1" <?php if($rT['voluntary']=='1'){echo'selected';}?> >Si</option>
                                                      <option value="0" <?php if($rT['voluntary']=='0'){echo'selected';}?> >No</option>
                                                 </select>

                                            </div>

                                            <div class="col-md-6">

                                               <label>Participando en nuestros eventos oficiales en Venezuela.*</label>
                                               <select id="reg_collabEvents" class="form-control mb-2 custom-select">
                                                      <option value="1" <?php if($rT['participateInEvents']=='1'){echo'selected';}?> >Si</option>
                                                      <option value="0" <?php if($rT['participateInEvents']=='0'){echo'selected';}?> >No</option>
                                                 </select>

                                            </div>
                                            <div class="col-md-6">

                                               <label>Aportando fondos y donaciones.*</label>
                                               <select id="reg_collabFunds" class="form-control mb-2 custom-select">
                                                      <option value="1" <?php if($rT['fundsAndDonations']=='1'){echo'selected';}?> >Si</option>
                                                      <option value="0" <?php if($rT['fundsAndDonations']=='0'){echo'selected';}?> >No</option>
                                                 </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">

                                               <label>¿Hay alguna otra forma como te gustaria colaborar?</label>
                                               <textarea id="reg_collabOther" class="form-control mb-2" placeholder="Dinos aqu&iacute;"><?=$rT['anotherWayToCollaborate']?></textarea>

                                            </div>
                                            
                                            <div class="col-12">
                                                 <hr/>
                                              <div id="restEditProfile" class="float-left"></div>
                                              <button type="submit" id="upUserManage" onclick="saveUserProfile()" class="btn btn-warning float-right">
                                                Actualizar
                                              </button>
                                              
                                                <script>
                                                    function saveUserProfile(){
                                                        var reg_name = $("#reg_name").val();
                                                        var reg_lastname = $("#reg_lastname").val();

                                                        var reg_CI = $("#reg_CI_type").val().trim() + "-" + $("#reg_CI").val();
                                                        var reg_birthdate = $("#reg_birthdate").val();
                                                        var reg_profession = $("#reg_profession").val();
                                                        var reg_codephone = $("#reg_codephone").val();
                                                        var reg_phone = $("#reg_phone").val();

                                                        var reg_wtpp = document.getElementById("reg_wtpp").checked;
                                                        var reg_tlg = document.getElementById("reg_tlg").checked;

                                                        var reg_country = $("#reg_country").val();
                                                        var reg_states = $("#reg_states").val();
                                                        var reg_city = $("#reg_city").val();
                                                        var reg_ideology = $("#reg_ideology").val();
                                                        var reg_social = $("#reg_social").val();
                                                        var reg_economic = $("#reg_economic").val();
                                                        var reg_anotherOrganization = $("#reg_anotherOrganization").val();
                                                        var reg_net1 = $("#reg_net1").val();
                                                        var reg_net2 = $("#reg_net2").val();
                                                        var reg_net3 = $("#reg_net3").val();
                                                        var reg_collabNet = $("#reg_collabNet").val();
                                                        var reg_collabVoluntary = $("#reg_collabVoluntary").val();
                                                        var reg_collabEvents = $("#reg_collabEvents").val();
                                                        var reg_collabFunds = $("#reg_collabFunds").val();
                                                        var reg_collabOther = $("#reg_collabOther").val();

                                                        editUserManage('<?=$rT['id']?>',reg_name, reg_lastname, reg_CI, reg_birthdate, reg_profession, reg_codephone, reg_phone, reg_wtpp, reg_tlg, reg_country, reg_states, reg_city, reg_ideology, reg_social, reg_economic, reg_anotherOrganization, reg_net1, reg_net2, reg_net3, reg_collabNet, reg_collabVoluntary, reg_collabEvents, reg_collabFunds, reg_collabOther);
                                                    }
                                                </script>
                                            </div>
                                        </div>
                 
                                    </div>
                                </div>
                            
                            </div>
                            
                            <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">
                                
                                  <div class="card mb-3">
                                      <div class="card-body">
                                        <div class="row">
                                           <div class="col">
                                              <label>
                                                  Usuario
                                              </label>
                                               <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text" id="inputGroupEditUser">
                                                          <span class="fas fa-user-circle"></span>
                                                      </span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Usuario" name="edit_username" id="edit_username" aria-describedby="inputGroupEditUser" value="<?=$rT['username'];?>" <?php if($rT['rank']>=$user['rank']  && $user['rank']!='3'){echo'disabled';}?>>
                                              </div>
                                           </div>
                                        </div>
                                      </div>
                                  </div>
                                  
                                  <div class="card mb-3">
                                      <div class="card-body">
                                        <div class="row">
                                           <div class="col">
                                              <label>
                                                  Correo electr&oacute;nico:
                                              </label>
                                               <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text" id="inputGroupEditEmail">
                                                          <span class="fas fa-envelope"></span>
                                                      </span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Correo electr&oacute;nico" name="edit_email" id="edit_email" aria-describedby="inputGroupEditEmail" value="<?=$rT['email'];?>" <?php if($rT['rank']>=$user['rank']  && $user['rank']!='3'){echo'disabled';}?>>
                                              </div>
                                           </div>
                                        </div>
                                      </div>
                                  </div>
                                  
                                  <div class="card mb-3">
                                      <div class="card-body">

                                        <div class="row">
                                            <div class="col">
                                            
                                            <?php
                                                if($rT['rank']>=$user['rank'] && $user['rank']!='3'){
                                                    echo "<input type='text' value='No puedes modificar el rango de este usuario.' class='form-control mb-1' disabled/>";
                                                }else{
                                            ?>
                                              <label for="userRank">Rango:</label>
                                               <select class="form-control custom-select" id="userRank">
                                                    <option value="0" <?php if($rT['rank']=='0'){echo'selected';}?> >Postulante</option>
                                                    <option value="1" <?php if($rT['rank']=='1'){echo'selected';}?>>Miembro</option>
                                                <?php
                                                    if($user['rank'] >= $context['permissions']['admin_config']){
                                                ?>
                                                    <option value="2" <?php if($rT['rank']=='2'){echo'selected';}?>>Coordinador</option>
                                                
                                                    <option value="3" <?php if($rT['rank']=='3'){echo'selected';}?>>Administrador</option>
                                                <?php
                                                    }
                                                ?>
                                               </select>
                                               <div id="resultRank" class="valid-feedback">
                                                </div>
                                                <hr/>
                                            <?php
                                                }
                                            ?>
                                                <div id="cong_res" class="float-left"></div>
                                                <button id="upCogUserManage" class="btn btn-warning float-right" onclick="saveUserCog()" <?php
                                                if($rT['rank']>=$user['rank']  && $user['rank']!='3'){echo'disabled';}?>>
                                                    Actualizar
                                                </button>
                                                
                                                <script>
                                                    $('#userRank').on('change', function(){
                                                        var reg_rank=$('#userRank').val();
                                                        rankUserManage('<?=$rT['id']?>', reg_rank);
                                                    });
                                                    function saveUserCog(){
                                                        var reg_username = $("#edit_username").val();
                                                        var reg_email = $("#edit_email").val();

                                                        cogUserManage('<?=$rT['id']?>',reg_username, reg_email);
                                                    }
                                                </script>
                                            </div>
                                        </div>

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
}
include(Templates . 'Footer.php');
?>