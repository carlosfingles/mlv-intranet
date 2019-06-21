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

$titlePage= 'Mis Temas en el Foro';
$descrPage = 'Mis Temas en el Foro de ' . $site['title'];
include(Templates . 'Head.php');
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
                                 Mis Temas
                        </li>
                        
                    </ol>
                </nav>
                
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>
                            Mis Temas en el Foro
                        </h3>
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

$obtener_todo_BD = "SELECT * FROM site_forums_topics WHERE author = '".$user['id']."'";

$consulta_todo = query($obtener_todo_BD);

$total_registros = num_rows($consulta_todo);

$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 

$consulta_resultados = query("
SELECT * FROM `site_forums_topics` WHERE author = '".$user['id']."'
ORDER BY `site_forums_topics`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");

if(num_rows($consulta_resultados) !== 0){
    
    while($ft = fetch_assoc($consulta_resultados)) {
        $authorData= query("SELECT * FROM site_users WHERE id = '".$ft['author']."' LIMIT 1");
        $author = fetch_assoc($authorData);
        
        $fcData= query("SELECT * FROM site_forums_category WHERE id = '".$ft['id_forums_category']."' LIMIT 1");
        $fc = fetch_assoc($fcData);
?>
            <div class="card bg-light mb-3" id="topic<?=$ft['id']?>">
               <div class="card-body">
                    <a href="<?=$site['url']?>forum/<?=$fc['url']?>/<?=$ft['id']?>" class="text-dark">
                        <h5 class="font-weight-bold"><?=$ft['title']?></h5>
                    </a>
                    <small>
                        <b>Creado por:</b> <?=$author['username']?> - <?=Site::CalculateTime($ft['date'])?>
                        <div class="position-absolute" style="top:5px; right:5px;">
                          
                           <span class="fas fa-edit cursor-pointer mx-1" onclick="editTopicForumModal('<?=$ft['id']?>')" data-toggle="modal" data-target="#editTopicForumModal"></span>
                            <span class="fas fa-trash cursor-pointer mx-1" onclick="deleteTopicForumModal('<?=$ft['id']?>', '<?=$ft['title']?>')" data-toggle="modal" data-target="#deleteTopicForumModal"></span>
                            
                        </div>
                        <br/>
                        <b>Publicado en:</b> <a href="<?=$site['url']?>forum/<?=$fc['url']?>" class="text-dark"><?=$fc['title']?></a>
                    </small>
                    <br/>
                    <?=Site::shortText(strip_tags(real_escape_string(stripslashes (htmlspecialchars_decode($ft['description'])))),80)?>
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
                <a class="page-link" href='?pagina=<?=$_GET["pagina"]-1?>' >
                    Anterior
                </a>
            </li>
        <?php
            }
        //Crea un bucle donde $i es igual 1, y hasta que $i sea menor o igual a X, a sumar (1, 2, 3, etc.)
        //Nota: X = $total_paginas
        //si total_de_paginas es mayor de 20 lo dejamos en 20 para evitar que visualmente se vea mal
        if($total_paginas>20){
            $total_paginas=20;
        }
        //creamos un for para mostrar las paginas de resultados disponibles
        for ($i=1; $i<=$total_paginas; $i++) {

            if($_GET["pagina"]==null){
                $_GET["pagina"]= '1';
            }

            //En el bucle, muestra la paginación

            if($_GET["pagina"]==$i){

                echo "<li class='page-item active'><a class='page-link' href='?pagina=".$i."'>".$i."</a></li>";
            }else{
                echo "<li class='page-item'><a class='page-link' href='?pagina=".$i."'>".$i."</a></li>";
            }
        }; 

            if($_GET["pagina"]==null and $i>2){
                echo'<li class="page-item">
                      <a class="page-link" href="?pagina=2">Next</a>
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
              <a class="page-link" href='?pagina=<?=$_GET["pagina"]+1?>'>Next</a>
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
include(Templates . 'Footer.php');
?>