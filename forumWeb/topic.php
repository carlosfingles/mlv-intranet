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
if(!isset($_SESSION['isLogged']) || !isset($_GET['q'])){
    echo"<script>window.location = '" . $site['url'] ."?secc=".base64_encode($escaped_link). "';</script>";
    exit();
}

$titlePage= 'No existe el tema';
$descrPage = $titlePage;

$id=$_GET['r'];
$ftDat= query("SELECT * FROM site_forums_topics WHERE id='".$id."'");
if(num_rows($ftDat)!==0){
    $ft= fetch_assoc($ftDat);
    $titlePage= $ft['title'];
    $descrPage = Site::shortText(strip_tags(real_escape_string(stripslashes (htmlspecialchars_decode($ft['description'])))),80);
}

include(Templates . 'Head.php');

    if(!isset($_GET['r'])){
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
                            NO EXISTE EL TEMA.
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }else{
        if(num_rows($ftDat)!==0){
            $fCDat= query("SELECT * FROM site_forums_category WHERE id='".$ft['id_forums_category']."'");
            $fC= fetch_assoc($fCDat);
            
            $authorData= query("SELECT * FROM site_users WHERE id = '".$ft['author']."' LIMIT 1");
            $author = fetch_assoc($authorData);
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
                            <a href="<?=$site['url']?>forum/<?=$fC['url']?>">
                                 <?=$fC['title']?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                                 <?=$ft['title']?>
                        </li>
                        
                    </ol>
                </nav>
                
               <div class="card mb-3 bg-light">
                   <div class="card-header bg-white">
                    <h5 class="mt-2"><?=$ft['title']?></h5>
                    <small>
                        <b>Creado por:</b> <a href="<?=$site['url']?>profile/<?=$author['username']?>" class="text-dark" target="_blank"><?=$author['username']?></a> - <?=Site::CalculateTime($ft['date'])?>
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
                   </div>
                   <div class="card-body">
                    <?=stripslashes(htmlspecialchars_decode($ft['description']))?>
                   </div>
               </div>

               <div class="card mb-3 bg-light">
                  <div class="card-header bg-white">
                      <h4>
                          Respuestas
                           <buttom class="btn btn-warning ml-1 mt-1 cursor-pointer" data-toggle="modal" data-target="#addRestTopic" type="buttom">
                               <span class="fas fa-pen"></span> Responder
                            </buttom>
                        </h4>
                       
                        <div class="modal fade" id="addRestTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-pen"></span> Responder</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                <div class="modal-body">
                                    <textarea class="html-editor form-control" id="commentTopic" placeholder="Responder..."></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="addCommentTopicSend" class="btn btn-info cursor-pointer" onclick="addCommentTopicSend()">
                                       Enviar
                                    </button>
                                   <script>
                                        editorHtml();
                                        function addCommentTopicSend(){
                                            var commentTopic= $('#commentTopic').val();
                                            var id_topic= '<?=$ft['id']?>';
                                            addCommentTopic(id_topic, commentTopic);
                                        }
                                   </script>
                                </div>
                              </div>
                            </div>
                          </div>
                       
                  </div>
                    <ul class="list-group list-group-flush">
<?php
error_reporting(E_ALL ^ E_NOTICE);

$cantidad_resultados_por_pagina = 12;

if (isset($_GET["pagina"])) {

    if (is_string($_GET["pagina"])) {
        
        if($_GET["pagina"] == 1){
            $pagina = $_GET["pagina"];

        }else{
            $pagina = $_GET["pagina"];
        }
    }

}else{
    $pagina = 1;
}

$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;

$obtener_todo_BD = "SELECT * FROM site_forums_comments WHERE id_topic = '".$ft['id']."'";

$consulta_todo = query($obtener_todo_BD);

$total_registros = num_rows($consulta_todo);

$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 

$consulta_resultados = query("
SELECT * FROM `site_forums_comments` WHERE id_topic = '".$ft['id']."'
ORDER BY `site_forums_comments`.`id` ASC
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");

if(num_rows($consulta_resultados) !== 0){

    while($r = fetch_assoc($consulta_resultados)) {
        $guserData= query("SELECT * FROM site_users WHERE id = '".$r['id_author']."' LIMIT 1");
        $guser = fetch_assoc($guserData);
?>
        <li class="list-group-item bg-light" id="comment<?=$r['id']?>">
        <div class="d-flex align-items-center">
          <img class="avatarNav inselect" src="<?=$site['url']?>/images/imgperfil/<?=$guser['avatar']?>"/>
           <div class="ml-1">
            <a href="<?=$site['url']?>profile/<?=$guser['username']?>" class="text-dark font-weight-bold"><?=$guser['username']?></a> - <small><?=Site::CalculateTime($r['time'])?></small>
            </div>
        </div>
            <?php
            if($guser['username']==$user['username'] || $user['rank']>=2){
                echo'<span class="fas fa-trash btn-top-right cursor-pointer ml-1" onclick="deleteCommentTopic(\''.$r['id'].'\')"></span>';
            }
            ?>
        <br/>
        <?=stripslashes(htmlspecialchars_decode($r['comment']))?>
        </li>
<?php
    }   
}else{
    echo'<li class="list-group-item bg-light">
    <center>
        <span class="fas fa-info-circle" aria-hidden="true" style="font-size: 800%; margin-top: 2%;"></span>
         <br>
        <div style="margin-top: 5%; margin-bottom:2%;">
            NO HAY COMENTARIOS.
        </div>
    </center>
    </li>';
}
?>
<li class="list-group-item">
<nav aria-label="Navegacion">
    <ul class="pagination">
        <?php
            $uri=explode('&', $_SERVER['REQUEST_URI']);
            if($_GET["pagina"]==null || $_GET["pagina"]==1){
                echo'<li class="page-item disabled">
                      <span class="page-link">Anterior</span>
                    </li>';
            }else{
            ?>
            <li class="page-item">
                <a class="page-link" href='<?=$uri[0]?>&pagina=<?=$_GET["pagina"]-1?>' >
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

                echo "<li class='page-item active'><a class='page-link' href='".$uri[0]."&pagina=".$i."'>".$i."</a></li>";
            }else{
                echo "<li class='page-item'><a class='page-link' href='".$uri[0]."&pagina=".$i."'>".$i."</a></li>";
            }
        }; 

            if($_GET["pagina"]==null and $i>2){
                echo'<li class="page-item">
                      <a class="page-link" href="'.$uri[0].'&pagina=2">Next</a>
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
              <a class="page-link" href='<?=$uri[0]?>&pagina=<?=$_GET["pagina"]+1?>'>Next</a>
            </li>

        <?php 
            }
        ?>
    </ul>
</nav>
</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
                                NO EXISTE EL TEMA.
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