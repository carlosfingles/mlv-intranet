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
    $q = query("SELECT * FROM site_forums_topics WHERE id = '" . $id . "'");
    if(num_rows($q) !== 0)
    {
        query("DELETE FROM site_forums_topics WHERE id = '" . $id . "'");
        query("DELETE FROM site_forums_comments WHERE id_topic = '" . $id . "'");
        $key = sha1(md5('topic'.$id));
        query("DELETE FROM site_data_emails WHERE keyPr = '" . $key . "'");

        echo 'Tema borrado con &eacute;xito.';
    }
    else
        echo 'El Tema no existe.';
}else{
    echo'No hay parametros';
}