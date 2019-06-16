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

$id = strip_tags(real_escape_string($_POST['id_category']));
$title = strip_tags(real_escape_string($_POST['title']));
$description = strip_tags(htmlentities(real_escape_string($_POST['description'])));

if(isset($_SESSION['isLogged']))
{
    if(!empty($id) && !empty($title) && !empty($description))
    {
        global $context;

        query("INSERT INTO site_forums_topics SET 
        date = '" . time() . "',
        author = '".$context['user']['id']."',
        title = '" . $title . "',
        description = '" . $description . "',
        id_forums_category = '" .$id. "'");
        $key = sha1(md5('topic'.insert_id()));
        query("INSERT INTO site_data_emails SET id_user = '" . $_SESSION['isLogged'] . "', type = 'topic', keyPr = '" . $key . "' ");
        
        echo 'add';
    }else
        echo 'No puedes dejar este campo vacio.';
}