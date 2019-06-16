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

require('./Clases/Class.Forum.php');

$id =$_GET['id'];

$fCDat= query("SELECT * FROM site_forums_category WHERE id = '$id'");
$fC= fetch_assoc($fCDat);
?>
<label for="title_edit">T&iacute;tulo:</label>
<input type="text" class="form-control mb-1" id="title_edit" placeholder="T&iacute;tulo" value="<?=$fC['title']?>"/>
<label for="description_edit">Descripci&oacute;n:</label>
<input type="text" class="form-control mb-1" id="description_edit" placeholder="Descripci&oacute;n" value="<?=$fC['description']?>"/>
<label for="url_edit">URL:</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="url-addon"><?=$site['url']?>forum/</span>
  </div>
  <input type="text" class="form-control" id="url_edit" aria-describedby="url-addon" placeholder="general" value="<?=$fC['url']?>">
</div>
<!---->
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
<button type="button" class="btn btn-primary" onclick="editCategoryForumSend()" id="editCategoryForumSend">Actualizar</button>
<script>
    function editCategoryForumSend(){
        var title=$('#title_edit').val();
        var desc=$('#description_edit').val();
        var url=$('#url_edit').val();
        editCategoryForum(<?=$id?>, title, desc, url);
    }
</script>