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

if(!isset($_SESSION['isLogged'])){
    echo"<script>window.location = '" . $site['url'] ."?secc=".base64_encode($escaped_link). "';</script>";
    exit();
}

$titlePage= 'Cancelar Suscripci&oacute;n al tema';
$descrPage = $titlePage;

include(Templates . 'Head.php');

    if(isset($_GET['key'])){
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
                <div class="card-body">
                    <?php
                    $q=query("SELECT * FROM site_data_emails WHERE keyPr = '" . $_GET['key'] . "' AND id_user = '" . $_SESSION['isLogged'] . "' ");
                    if(num_rows($q)==0){
                    ?>
                       <div class="alert alert-danger" role="alert">
                            No se encontro la suscripci&oacute;n al tema.
                        </div>
                    <?php
                    }else{
                        query("DELETE FROM site_data_emails WHERE keyPr = '" . $_GET['key'] . "' AND id_user = '" . $_SESSION['isLogged'] . "' ");
                    ?>
                        <div class="alert alert-success" role="alert">
                            Se ha cancelado la suscripci&oacute;n al tema.
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }else{
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
                <div class="card-body">
                    <center>
                        <span class="fas fa-info-circle" aria-hidden="true" style="font-size: 800%; margin-top: 2%;"></span>
                         <br>
                        <div style="margin-top: 5%; margin-bottom:2%;">
                            LA SUSCRIPCI&Oacute;N YA FUE CANCELADA.
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    }
include(Templates . 'Footer.php');
?>