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

$ftDat= query("SELECT * FROM site_forums_topics WHERE id='".$_GET['id']."'");
$ft= fetch_assoc($ftDat);
?>
<label for="title">Asunto:</label>
<input type="text" class="form-control mb-1" id="title_edit" placeholder="Asunto" value="<?=$ft['title']?>"/>
<textarea class="form-control html-editor" id="description_edit" placeholder="Descripci&oacute;n"><?=stripslashes(htmlspecialchars_decode($ft['description']))?></textarea>
<!---->
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
<button type="button" class="btn btn-primary" onclick="editTopicForumSend()" id="editTopicForumSend">Actualizar</button>
<script>
editorHtml();
function editTopicForumSend(){
var title=$('#title_edit').val();
var desc=$('#description_edit').val();
editTopicForum('<?=$ft['id']?>', title, desc);
}
</script>
