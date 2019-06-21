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

if(!isset($_SESSION['isLogged']) || $user['rank'] < $context['permissions']['admin_home']){
    echo"<script>window.location = '" . $site['url'] . "';</script>";
    exit();
}

$titlePage= 'Dashboard';
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
                            <h4 class="font-weight-bold m-0 p1">Administraci&oacute;n</h4>
                        </li>
                        
                        <li class="list-group-item">
                            <div class="row mt-3">
                            <?php
                                if($user['rank'] >= $context['permissions']['admin_users']){
                            ?>
                                <div class="col-md-6">
                                    <div class="card bg-success text-white my-1">
                                        <div class="card-body d-flex flex-column">
                                           <p class="d-flex justify-content-center"><span class="fas fa-users font-size-180"></span></p>
                                            <p class="d-flex justify-content-center mb-0">
                                                <a href="<?=$site['url']?>manage/users" class="text-white stretched-link">Usuarios</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                                if($user['rank'] >= $context['permissions']['admin_config']){
                            ?>
                                <div class="col-md-6">
                                    <div class="card bg-info text-white my-1">
                                        <div class="card-body d-flex flex-column">
                                            <p class="d-flex justify-content-center"><span class="fas fa-cogs font-size-180"></span></p>
                                            <p class="d-flex justify-content-center mb-0">
                                                <a href="<?=$site['url']?>manage/configuration" class="text-white stretched-link">Configuraci&oacute;n</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                                if($user['rank'] >= $context['permissions']['admin_users']){
                            ?>
                                <div class="col-md-6">
                                    <div class="card bg-danger text-white my-1">
                                        <div class="card-body d-flex flex-column">
                                            <p class="d-flex justify-content-center"><span class="fas fa-bullhorn font-size-180"></span></p>
                                            <p class="d-flex justify-content-center mb-0">
                                                <a href="<?=$site['url']?>manage/forum" class="text-white stretched-link">Foro</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
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