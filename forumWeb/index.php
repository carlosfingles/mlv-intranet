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

$titlePage= 'Foro';
$descrPage = 'Foro de ' . $site['title'];
include(Templates . 'Head.php');

    if(!isset($_GET['q'])){
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
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white border">
                        <li class="breadcrumb-item">
                            <a href="<?=$site['url']?>">
                                <span class="fas fa-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                                 Foro
                        </li>
                    </ol>
                </nav>
                      
                <div class="card mb-3">
                    <div class="card-body">
                      <h1 class="m-0 p-1">Foro</h1>
                      <hr/>
                        <div class="card bg-info mb-3 text-white">
                           <div class="card-body">
                                <a href="<?=$site['url']?>mytopics" class="stretched-link text-white">
                                    <h5 class="font-weight-bold">Mis Temas</h5>
                                </a>
                                Aqu&iacute; podras ver todos los temas que haz creado.
                           </div>
                        </div>
                      <?php
                        $fCatDat= query("SELECT * FROM site_forums_category ORDER BY id");
                        if(num_rows($fCatDat)!==0){
                            while($fCat=fetch_assoc($fCatDat)){
                                $cantTopicData= query("SELECT * FROM site_forums_topics WHERE id_forums_category = '".$fCat['id']."' ORDER BY id DESC");
                                $cantTopic = num_rows($cantTopicData);
                                if($cantTopic!==0){
                                    $rTop= fetch_assoc($cantTopicData);
                                    $qAutTopic= query("SELECT * FROM site_users WHERE id = '".$rTop['author']."' LIMIT 1");
                                    $autTop=fetch_assoc($qAutTopic);
                                }
                        ?>
                            <div class="card bg-light mb-3">
                               <div class="card-body">
                                    <a href="<?=$site['url']?>forum/<?=$fCat['url']?>" class="stretched-link text-dark">
                                        <h5 class="font-weight-bold"><?=$fCat['title']?></h5>
                                    </a>
                                    <?=$fCat['description']?>
                                    <br/>
                                    <small><span class="fas fa-book"></span> <?=$cantTopic?><?php if($cantTopic!==0){ ?> - <b>&Uacute;ltimo tema por:</b> <?=$autTop['username']?>-<?=Site::CalculateTime($rTop['date'])?><?php }?></small>
                               </div>
                           </div>
                      <?php
                            }
                        }else{
                        ?>
                            <div class="card bg-light mb-3">
                               <div class="card-body">
                                    <center>
                                        <span class="fas fa-info-circle" aria-hidden="true" style="font-size: 800%; margin-top: 2%;"></span>
                                         <br>
                                        <div style="margin-top: 5%; margin-bottom:2%;">
                                            NO HAY CATEGOR&Iacute;AS.
                                        </div>
                                    </center>
                               </div>
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
        $url=explode('.' , $_GET['q']);
        $fCDat= query("SELECT * FROM site_forums_category WHERE url='".$url[0]."'");
        if(num_rows($fCDat)!==0){
            $fC= fetch_assoc($fCDat);
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
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white border">
                        <li class="breadcrumb-item">
                            <a href="<?=$site['url']?>">
                                <span class="fas fa-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?=$site['url']?>forum">
                                 Foro
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                                 <?=$fC['title']?>
                        </li>
                        
                    </ol>
                </nav>
                
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>
                            Foro <?=$fC['title']?>
                            <buttom class="btn btn-warning mt-1 ml-1 cursor-pointer" data-toggle="modal" data-target="#addTopic">
                                <span class="fas fa-plus"></span> Agregar Tema
                              </buttom>
                        </h3>
                        
                        <div class="modal fade" id="addTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-plus"></span> Agregar Tema</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <label for="title">Asunto:</label>
                                <input type="text" class="form-control mb-1" id="title" placeholder="Asunto"/>
                                  <textarea class="form-control html-editor" id="description" placeholder="Descripci&oacute;n"></textarea>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="addTopicForumSend()" id="addTopicForumSend">Aceptar</button>
                                <script>
                                    editorHtml();
                                    function addTopicForumSend(){
                                        var title=$('#title').val();
                                        var desc=$('#description').val();
                                        addTopicForum('<?=$fC['id']?>', title, desc);
                                    }
                                </script>
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        <hr/>

<?php

error_reporting(E_ALL ^ E_NOTICE);

$cantidad_resultados_por_pagina = 12;

if (isset($_GET["pagina"])) {

	if (is_string($_GET["pagina"])) {
        
			 if ($_GET["pagina"] == 1) {
				 $pagina = $_GET["pagina"];
				 
			 } else {
				 $pagina = $_GET["pagina"];
			};
	};

} else { 
	$pagina = 1;
};

$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;

$obtener_todo_BD = "SELECT * FROM site_forums_topics WHERE id_forums_category = '".$fC['id']."'";

$consulta_todo = query($obtener_todo_BD);

$total_registros = num_rows($consulta_todo);

$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 

$consulta_resultados = query("
SELECT * FROM `site_forums_topics` WHERE id_forums_category = '".$fC['id']."'
ORDER BY `site_forums_topics`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");

if(num_rows($consulta_resultados) !== 0){
    
    while($ft = fetch_assoc($consulta_resultados)) {
        $cantCommentData= query("SELECT * FROM site_forums_comments WHERE id_topic = '".$ft['id']."' ORDER BY id DESC");
        $cantComment = num_rows($cantCommentData);
        if($cantComment!==0){
            $rComment= fetch_assoc($cantCommentData);
            $qAutComment= query("SELECT * FROM site_users WHERE id = '".$rComment['id_author']."' LIMIT 1");
            $autComment=fetch_assoc($qAutComment);
        }
        
        $authorData= query("SELECT * FROM site_users WHERE id = '".$ft['author']."' LIMIT 1");
        $author = fetch_assoc($authorData);
?>
            <div class="card bg-light mb-3" id="topic<?=$ft['id']?>">
               <div class="card-body">
                    <a href="<?=$site['url']?>forum/<?=$url[0]?>/<?=$ft['id']?>" class="stretched-link text-dark">
                        <h5 class="font-weight-bold"><?=$ft['title']?></h5>
                    </a>
                    <small>
                        <b>Creado por:</b> <?=$author['username']?> - <?=Site::CalculateTime($ft['date'])?>
                    <?php
                        if($ft['author']==$user['id'] || $user['rank']>=2){
                    ?>
                        <div class="position-absolute" style="top:5px; right:5px; z-index: 1;">
                          
                           <span class="fas fa-edit cursor-pointer mx-1" onclick="editTopicForumModal('<?=$ft['id']?>')" data-toggle="modal" data-target="#editTopicForumModal"></span>
                            <span class="fas fa-trash cursor-pointer mx-1" onclick="deleteTopicForumModal('<?=$ft['id']?>', '<?=$ft['title']?>')" data-toggle="modal" data-target="#deleteTopicForumModal"></span>
                            
                        </div>
                    <?php
                        }
                    ?>
                    </small>
                    <br/>
                    <?=Site::shortText(strip_tags(real_escape_string(stripslashes (htmlspecialchars_decode($ft['description'])))),80)?>
                    <br/>
                    <small><span class="fas fa-comment"></span> <?=$cantComment?><?php if($cantComment!==0){ ?> - <b>&Uacute;ltimo comentario por:</b> <?=$autComment['username']?>-<?=Site::CalculateTime($rComment['time'])?><?php }?></small>
               </div>
           </div>
<?php
    }   
?>

<div class="modal fade" id="editTopicForumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-edit"></span> Editar Tema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editTopicDataBody">
      </div>
      <div class="modal-footer" id="editTopicDataFooter">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteTopicForumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-trash"></span> Eliminar Tema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="delTopicDataBody">
      </div>
      <div class="modal-footer" id="delTopicDataFooter">
      </div>
    </div>
  </div>
</div>
<?php 
}else{
    echo'
    
        <div class="card bg-light mb-3">
           <div class="card-body">
                <center>
                    <span class="fas fa-info-circle" aria-hidden="true" style="font-size: 800%; margin-top: 2%;"></span>
                     <br>
                    <div style="margin-top: 5%; margin-bottom:2%;">
                        NO HAY TEMAS.
                    </div>
                </center>
           </div>
       </div>
    
    ';
};
?>
<hr/>           

    <nav aria-label="Navegacion">
        <ul class="pagination">
            <?php
                if($_GET["pagina"]==null || $_GET["pagina"]==1){
                    echo'<li class="page-item disabled">
                          <span class="page-link">Anterior</span>
                        </li>';
                }else{
                ?>
                <li class="page-item">
                    <a class="page-link" href='<?=$url[0]?>&pagina=<?=$_GET["pagina"]-1?>' >
                        Anterior
                    </a>
                </li>
            <?php
                }
            
            if($total_paginas>20){
                $total_paginas=20;
            }
            
            for ($i=1; $i<=$total_paginas; $i++) {
                
                if($_GET["pagina"]==null){
                    $_GET["pagina"]= '1';
                }
                
                if($_GET["pagina"]==$i){
                    
                    echo "<li class='page-item active'><a class='page-link' href='".$url[0]."&pagina=".$i."'>".$i."</a></li>";
                }else{
                    echo "<li class='page-item'><a class='page-link' href='".$url[0]."&pagina=".$i."'>".$i."</a></li>";
                }
            }; 

                if($_GET["pagina"]==null and $i>2){
                    echo'<li class="page-item">
                          <a class="page-link" href="'.$url[0].'&pagina=2">Next</a>
                        </li>';
                }else if($_GET["pagina"]==$i-1){
                    echo'<li class="page-item disabled">
                          <span class="page-link">Siguiente</span>
                        </li>';
                }else if($_GET["pagina"]==null and $i==2){
                    echo'<li class="page-item disabled">
                          <span class="page-link">Siguiente</span>
                        </li>';
                }else{
                ?>
                
                <li class="page-item">
                  <a class="page-link" href='<?=$url[0]?>&pagina=<?=$_GET["pagina"]+1?>'>Next</a>
                </li>
                  
            <?php 
                }
            ?>
        </ul>
    </nav>
 
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
                                    NO EXISTE LA CATEGOR&Iacute;A.
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        }
    }
include(Templates . 'Footer.php');
?>