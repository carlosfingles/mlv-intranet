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

if(!isset($_SESSION['isLogged']) || $user['rank'] < $context['permissions']['admin_users']){
    echo"<script>window.location = '" . $site['url'] . "';</script>";
    exit();
}

$titlePage= 'Newsletter';
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
                <div class="card mb-3 bg-light">
                    <div class="card-header bg-white">
                        <h4 class="font-weight-bold m-0 p1">Newsletter - <small>Enviar Correo Electr&oacute;nico</small></h4>
                    </div>

                    <div class="card-body">
                        <div class="row mt-3">
                          <div class="col-12">

                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group">

                                        <select id="reg_country" onchange="newsletterStates('true')" class="form-control mb-2 custom-select">
                                        <?php
                                           if($user['rank']!='2'){
                                        ?>
                                            <option value="nulo">Elegir Pais</option>
                                        <?php
                                                $catCoincide= query ("SELECT * FROM site_users ORDER by id ASC");

                                                $catArray= array("-----");

                                                while($rCat = fetch_assoc($catCoincide))
                                                {

                                                   $catco= $rCat['country'];

                                                    if(!array_search($catco, $catArray)){
                                                        $countryDat= query ("SELECT * FROM countries WHERE id ='" . $rCat['country'] . "' ");
                                                        $countries = fetch_assoc($countryDat);
                                                    ?>
                                                        <option value="<?=$countries['id'];?>"><?=$countries['name']?></option>
                                                <?php
                                                    }

                                                    $catArray[]= $rCat['country'];

                                                }
                                           }else{
                                               $countryDat= query ("SELECT * FROM countries WHERE id ='" . $user['country'] . "' ");
                                                $countries = fetch_assoc($countryDat);
                                        ?>
                                                <option value="<?=$countries['id'];?>"><?=$countries['name']?></option>
                                        <?php
                                           }
                                        ?>
                                        </select>

                                        <select id="reg_states" onchange="newsletterCountry()" class="form-control mb-2 custom-select">
                                            <option value="nulo">Elegir Estado/Provincia</option>
                                        </select>

                                        <select id="reg_rank" onchange="newsletterCountry()" class="form-control mb-2 custom-select">
                                            <option value="nulo">Todos</option>
                                            <option value="0">Postulantes</option>
                                            <option value="1">Miembros</option>
                                            <option value="2">Coordinadores</option>
                                            <option value="3">Administradores</option>
                                        </select>

                                    </div>
                                    <script>newsletterStates('true');</script>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fa-envelope">
                                                Para:
                                            </span>
                                        </div>
                                        <input type="text" id="mail_address" class="form-control" placeholder="Ejem: user1@gmail.com, user2@gmail.com, user3@gmail.com" aria-label="Destinatarios" aria-describedby="fa-envelope">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fa-envelope">
                                                Asunto:
                                            </span>
                                        </div>
                                        <input type="text" id="mail_subject" class="form-control" placeholder="Asunto" aria-label="Asunto" aria-describedby="fa-envelope">
                                    </div>
                                    <textarea class="html-editor" placeholder="Mensaje" id="mail_content"></textarea>
                                    <script>
                                        editorHtml();
                                        $('.trumbowyg-editor').css({"background-color":"white"});
                                    </script>
                                    
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="float-left" id="mail_rest"></div>
                                            <button type="button" class="btn btn-warning float-right ml-1" id="newsletterSend" onclick="newsletterSend()">
                                                Enviar
                                            </button>
                                            <script>
                                                function newsletterSend(){
                                                    var address= $('#mail_address').val();
                                                    var subject= $('#mail_subject').val();
                                                    var content= $('#mail_content').val();
                                                    newsletter(address, subject, content);
                                                }
                                            </script>
                                        </div>
                                    </div>
                               </div>
                            </div>

                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include(Templates . 'Footer.php');
?>