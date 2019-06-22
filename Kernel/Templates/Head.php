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

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$urlPage= "http://" . $host . $url;

$mystring = $context['site']['url'];
$pos1 = strpos($mystring, 'https');
if($pos1 !== false){
    $urlPage= "https://" . $host . $url;
    if (!isset($_SERVER['HTTPS'])) {
        $uriName= trim($mystring, '/');
        echo"<script>window.location = '".$uriName.$_SERVER['REQUEST_URI']."';</script>";
        exit();
    }
}

$pos2 = strpos($mystring, 'www.');
if($pos2 !== false){
    $uri=  $_SERVER['SERVER_NAME'];
    $finduri='www.';
    $posuri= strpos($uri, $finduri);
    if ($posuri === false) {
        $uriName2= trim($mystring, '/');
        echo"<script>window.location = '".$uriName2.$_SERVER['REQUEST_URI']."';</script>";
        exit();
    }
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
    $titleSite= $titlePage." | ".$context['site']['title'];
?>
<title><?=Site::shortText($titleSite, 65);?></title>

<meta name="description" content="<?=Site::shortText($context['site']['slogan'], 150);?>">
<meta name="keywords" content="<?=$context['site']['keywords'];?>">
<meta name="author" content="<?=$site['author'];?>">
<link rel='image_src' href='<?=$context['site']['url'];?>images/image/seo_og/<?=$site['ogImg'];?>' type='image/jpeg'>

<?php if($site['twitterSeo']=='true'){?>

<meta name="twitter:card" value="summary_large_image">
<meta name="twitter:site" content="@<?=$site['twitterUser'];?>">
<meta name="twitter:title" content="<?=Site::shortText($titleSite, 65);?>">
<meta name="twitter:description" content="<?=Site::shortText($descrPage, 155);?>">
<meta name="twitter:domain" content="<?=$context['site']['url'];?>">
<meta name="twitter:url" content="<?=$urlPage;?>">

<meta name="twitter:image" content="<?=$context['site']['url'];?>images/image/seo_twitter/<?=$site['twitterImg'];?>">
<?php } ?>

<meta property="og:title" content="<?=Site::shortText($titleSite, 65);?>" />
<meta property="og:type" content="<?php if(isset($metaProd) && $metaProd=='true'){echo'og:product';}else{echo'article';};?>" />
<meta property="og:url" content="<?=$urlPage;?>" />
<?php
if (isset($metaProd) && $metaProd=='true'){
?>
<meta property="og:image" content="<?=$context['site']['url'];?>images/news_fader/<?=$imgCourses?>" />
<?php
}else{
?>
<meta property="og:image" content="<?=$context['site']['url'];?>images/image/seo_og/<?=$site['ogImg'];?>" />
<?php    
}
?>
<meta property="og:description" content="<?=Site::shortText($descrPage, 155);?>" />
<meta property="og:site_name" content="<?=$context['site']['title'];?>" />
<meta property="og:locale" content="en_ES" />

<script>
	var site_url = "<?=$context['site']['url'];?>";
</script>

<script src="<?=$context['site']['url'];?>src/scripts/jquery.js" type="text/javascript"></script>
<script src="<?=$context['site']['url'];?>src/scripts/jquery-resizable.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?=$context['site']['url'];?>src/styles/bootstrap/bootstrap.min.css">
<script src="<?=$context['site']['url'];?>src/scripts/popper.min.js"></script>
<script src="<?=$context['site']['url'];?>src/scripts/bootstrap/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?=$context['site']['url'];?>src/styles/fontawesome/css/all.min.css">

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 

<link rel="stylesheet" href="<?=$context['site']['url'];?>/src/styles/redesIconos/style.css" type="text/css" />

<link rel="shortcut icon" href="<?=$context['site']['url'];?>images/favicon/<?=$site['favicon'];?>" />

<link rel="stylesheet" media="screen" href="<?=$context['site']['url'];?>src/styles/style-b.css">

<script src="<?=$context['site']['url'];?>src/scripts/progress/jquery.ajax-progress.js"></script>
<script src="<?=$context['site']['url'];?>src/scripts/Kernel.js" type="text/javascript"></script>
<script src="<?=$context['site']['url'];?>src/scripts/Users.js" type="text/javascript"></script>
<script src="<?=$context['site']['url'];?>src/scripts/Pixelario.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?=$context['site']['url'];?>src/dist/ui/trumbowyg.min.css">
<script src="<?=$context['site']['url'];?>src/dist/trumbowyg.js"></script>
<script src="<?=$context['site']['url'];?>src/dist/langs/es.min.js"></script>
<script src="<?=$context['site']['url'];?>src/dist/plugins/pasteimage/trumbowyg.pasteimage.js"></script>
<script src="<?=$context['site']['url'];?>src/dist/plugins/resizimg/trumbowyg.resizimg.js"></script>
<script src="<?=$context['site']['url'];?>src/dist/plugins/history/trumbowyg.history.js"></script>
<script src="<?=$context['site']['url'];?>src/dist/plugins/noembed/trumbowyg.noembed.min.js"></script>

<script src="<?=$context['site']['url'];?>src/scripts/Functions.js"></script>

<script src="<?=$context['site']['url'];?>src/scripts/js.cookies.js"></script>

<?=stripslashes (htmlspecialchars_decode($site['scriptHead']))?>

</head>

<body>
<?php
    include(Templates . 'SiteNav.php');
?>
