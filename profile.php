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

$profile = @$_GET['profile'];
$tP='Perfil no encontrado';
$dscP=$tP;
$qT = query("SELECT * FROM site_users WHERE username = '" . $profile . "' LIMIT 1");
if(num_rows($qT) != 0)
{
    $rT = fetch_assoc($qT);
    $tP = $rT['name'] . ' ' . $rT['lastname'] . ' ('.$rT['username'].')';
    $dscP=$context['site']['slogan'];
}

$titlePage= $tP;
$descrPage = $dscP;

include(Templates . 'Head.php');

if(!isset($profile))
	header("Location: " . $context['site']['url']);

$sql = query("SELECT * FROM site_users WHERE username = '" . $profile . "' LIMIT 1");

if(num_rows($sql) != 0)
{
    $row = fetch_assoc($sql);
?>

<div class="container-fluid content-min-100vh">
    <div class="row">
        <div class="col-12">
            <div class="card my-3">
                <div style="background-image: url('<?=$site['url']?>/images/imgcover/<?=$row['cover']?>')" class="coverProfile card-img-top">
                    <div class="bg-cover d-flex justify-content-center align-items-center flex-column text-white">
                        <div class="avatarProfile shadowBorder m-1" style="background-image: url('<?=$site['url']?>/images/imgperfil/<?=$row['avatar']?>')"></div>
                        <?=$row['name']?> <?=$row['lastname']?> (@<?=$row['username'];?>)
                    </div>
                </div>
              <div class="card-body">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="mb-0 font-weight-bold p-1">Informaci&oacute;n Sobre <?=$row['name']?> <?=$row['lastname']?> </h5>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </li>
                    </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<?php
}
else
{
?>
<div id="indexHeader content-min-100vh">
   <div id="barParticles"></div>
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row p-2 p-md-5">
                <div class="col">
                    <div class="card bg-light shadowBorder-1" style="min-height: 70vh;">
                      <div class="card-header">
                        <center>Error 404 >> Perfil no encontrado</center>
                      </div>
                       <div class="card-body bgSectionWhite d-flex justify-content-center align-items-center"> 
                           <img src="../../images/image/images/404.png" class="inselect" style="width: 100%; height: auto; max-width: 604px;">
                       </div>
                    </div>
                </div>
            </div>
          
        </div>
        
    </div>
</div>
<?php
}
include(Templates . 'Footer.php');
?>