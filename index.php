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

if(isset($_SESSION['isLogged']) && isset($_GET['secc']) && isset($_GET['secc'])!=''){
	header("Location: http://" . base64_decode($_GET['secc']));
}

$titlePage= $context['site']['slogan'];
$descrPage = $titlePage;
include(Templates . 'Head.php');

    if(!isset($_SESSION['isLogged'])){
?>
<div id="indexHeader" class="content-min-100vh">
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row p-2 p-md-5">
                <div class="col-12">
                    <div class="jumbotron p-5">
                      <h1 class="display-4">Bienvenido a la libertad!</h1>
                       <p>Esta pagina esta en evolucion permanente. En caso de problemas, por favor contactanos a: <a href="mailto:it@mlv-intranet.org" class="text-dark">it@mlv-intranet.org</a></p>
                      <hr class="my-2">
                      <p style="font-size: 90%;" class="font-weight-bold">Si eres desarrollador web, colabora para mejorar la pagina!</p>
                      <div class="mb-5">
                          <a class="btn btn-dark btn-lg float-right" type="button" data-toggle="modal" data-target="#loginModal" href="#">Ingresar</a>
                      </div>
                    </div>
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
                      <h1>Noticias!</h1>
                        <div class="font-size-14">
                            <p>Bienvenido a todos!</p>
                            <p>Por los momentos, el intranet funcionara solo para mantener el registro de usuarios al día. Con el tiempo iremos incluyendo herramientas de comunicación interna.</p>
                            <p>Asegúrese al registrarse que los datos son los correctos, ya que en función de ellos los contactaremos para participar en los diferentes proyectos.</p>
                            <p>También procure tenerlos al día en caso de mudanza o de emigrar del país.</p>
                            <p>Muchas gracias, y no dude en contactarnos en caso de cualquier pregunta.</p>
                            <p>Jorge Perez, Director IT.</p>
                        </div>
                        <hr class="my-2">
                        <h3>Estatus Actual</h3>
                        <div class="font-size-14">
                            <p>Usted tiene el rango de <b><?=$user['rankname']?></b> en el MLV.</p>
                            <p>En caso de necesitar un comprobante, puede contactar al secretario nacional: <a href="mailto:movi.libertariovzla@gmail.com">movi.libertariovzla@gmail.com</a></p>
                        </div>
                        <hr class="my-2">
                        <h3>Espacio Personal</h3>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card bg-success text-white mb-1">
                                    <div class="card-body d-flex flex-column">
                                       <p class="d-flex justify-content-center"><span class="fas fa-bullhorn font-size-180"></span></p>
                                        <p class="d-flex justify-content-center mb-0">
                                            <a href="<?=$site['url']?>forum" class="text-white stretched-link">Foro</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-info text-white mb-1">
                                    <div class="card-body d-flex flex-column">
                                        <p class="d-flex justify-content-center"><span class="fas fa-comment font-size-180"></span></p>
                                        <p class="d-flex justify-content-center mb-0">
                                            <a href="<?=$site['url']?>chat" class="text-white stretched-link">Chat</a>
                                        </p>
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
    }
?>
    <div class="bg-dark p-4">
       <center>
           <img src="<?=$context['site']['url'];?>/images/image/Footer/logo.png" width="300">
       </center>
       <?php
        if(isset($_GET['secc'])){
            echo'<script>$("[data-target=\'#loginModal\']").click();</script>';
        }
        ?>
    </div>
</body>
</html>