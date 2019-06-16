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

$id = $_POST['id'];

if(!empty($id))
{
    $q = query("SELECT * FROM site_forums_comments WHERE id = '" . $id . "'");
    if(num_rows($q) !== 0)
    {
        query("DELETE FROM site_forums_comments WHERE id = '" . $id . "'");

        echo 'Comentario borrado con &eacute;xito.';
    }
    else
        echo 'El comentario no existe.';
}else{
    echo'No hay parametros';
}