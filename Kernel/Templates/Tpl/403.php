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

require('../../../Init.php');
$titlePage= 'Acceso prohibido';
$descrPage = $context['site']['slogan'];

include(Templates . 'Head.php');
?>
<div id="indexHeader" class="content-min-100vh">
   <div id="barParticles"></div>
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row p-2 p-md-5">
                <div class="col">
                    <div class="card bg-light shadowBorder-1" style="min-height: 70vh;">
                      <div class="card-header">
                        <center>Error 403 >> Acceso prohibido</center>
                      </div>
                       <div class="card-body bgSectionWhite d-flex justify-content-center align-items-center"> 
                           <img src="<?=$site['url']?>/images/image/images/404.png" class="inselect" style="width: 100%; height: auto; max-width: 604px;">
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