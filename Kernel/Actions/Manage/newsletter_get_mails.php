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

require('./Class/Class.User.php');

error_reporting(E_ALL ^ E_NOTICE);

if($_GET["country"]=='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users";
}

if($_GET["country"]!='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."'";
}

if($_GET["country"]=='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE state='".$_GET["state"]."'";
}

if($_GET["country"]!='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."' AND state='".$_GET["state"]."'";
}

if($_GET["country"]=='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE rank='".$_GET["rank"]."'";
}

if($_GET["country"]!='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."' AND rank='".$_GET["rank"]."' ";
}

if($_GET["country"]=='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE state='".$_GET["state"]."' AND rank='".$_GET["rank"]."'";
}

if($_GET["country"]!='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."' AND state='".$_GET["state"]."' AND rank='".$_GET["rank"]."'";
}

$consulta_todo = query($obtener_todo_BD);

if(num_rows($consulta_todo)!==0){
    $mails='';
    $mailscount=1;
    while($r=fetch_assoc($consulta_todo)){
        if($mailscount=='1'){
            $mails .=$r['email'];
        }else{
            $mails .=','.$r['email'];
        }
        $mailscount+=1;
    }
    echo $mails;
}else{
    echo'No hay usuarios';
}
?>