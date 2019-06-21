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

$titlePage= 'Foro';
$descrPage = 'Administrar foro de '. $site['url'];
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
                            <h4 class="font-weight-bold m-0 p1">Foro</h4>
                        </li>
                        
                        <li class="list-group-item">
                            <buttom class="btn btn-warning cursor-pointer" data-toggle="modal" data-target="#addCategory">
                                <span class="fas fa-bookmark"></span> Agregar Categor&iacute;a
                            </buttom>
                            
                            <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-bookmark"></span> Agregar Categor&iacute;a</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <label for="title">T&iacute;tulo:</label>
                                    <input type="text" class="form-control mb-1" id="title" placeholder="T&iacute;tulo"/>
                                    <label for="description">Descripci&oacute;n:</label>
                                    <input type="text" class="form-control mb-1" id="description" placeholder="Descripci&oacute;n"/>
                                    <label for="url">URL:</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="url-addon"><?=$site['url']?>forum/</span>
                                      </div>
                                      <input type="text" class="form-control" id="url" aria-describedby="url-addon" placeholder="general">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" onclick="addCategoryForumSend()" id="addCategoryForumSend">Aceptar</button>
                                    <script>
                                        function addCategoryForumSend(){
                                            var title=$('#title').val();
                                            var desc=$('#description').val();
                                            var url=$('#url').val();
                                            addCategoryForum(title, desc, url);
                                        }
                                    </script>
                                  </div>
                                </div>
                              </div>
                            </div>
                           
                            <hr/>
                          <?php
                            $fCatDat= query("SELECT * FROM site_forums_category ORDER BY id");
                            if(num_rows($fCatDat)!==0){
                                while($fCat=fetch_assoc($fCatDat)){
                            ?>
                                <div class="card bg-light mb-3 FC<?=$fCat['id']?>">
                                   <div class="card-body">
                                        <a href="<?=$site['url']?>forum/<?=$fCat['url']?>" class="text-dark font-weight-bold" style="font-size: 1.25rem;">
                                            <?=$fCat['title']?>
                                        </a>
                                        <div class="float-right">
                                            <span class="fas fa-edit cursor-pointer" onclick="editCategoryForumModal('<?=$fCat['id']?>')" data-toggle="modal" data-target="#editCategory"></span>
                                            
                                            <span class="fas fa-trash cursor-pointer" onclick="deleteCategoryForumModal('<?=$fCat['id']?>', '<?=$fCat['title']?>')" data-toggle="modal" data-target="#deleteCategory"></span>
                                       </div>
                                        <br/>
                                        <?=$fCat['description']?>
                                   </div>
                               </div>
                          <?php
                                }
                            ?>
                            
                            <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-edit"></span> Editar Categor&iacute;a</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body" id="delDataBodyEdit">
                                  </div>
                                  <div class="modal-footer" id="delDataFooterEdit">
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                            <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-trash"></span> Eliminar Categor&iacute;a</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body" id="delDataBody">
                                  </div>
                                  <div class="modal-footer" id="delDataFooter">
                                  </div>
                                </div>
                              </div>
                            </div>

                          <?php
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
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
include(Templates . 'Footer.php');
?>